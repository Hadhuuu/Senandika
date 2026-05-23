<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Symptom;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    // Proteksi: Hanya admin yang bisa akses
    private function checkAdmin()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Ditolak. Hanya Admin yang dapat melihat Analytics.');
        }
    }

    /**
     * Get monthly urgency trends
     * Returns data for line chart: Tren Urgensi per Bulan
     */
    public function monthlyUrgency(): JsonResponse
    {
        $this->checkAdmin();
        $data = Assessment::selectRaw('
                MONTH(created_at) as month,
                YEAR(created_at) as year,
                COUNT(*) as total_assessment,
                AVG(final_score) as avg_score,
                COUNT(CASE WHEN final_score >= 80 THEN 1 END) as high_urgency,
                COUNT(CASE WHEN final_score >= 50 AND final_score < 80 THEN 1 END) as medium_urgency,
                COUNT(CASE WHEN final_score < 50 THEN 1 END) as low_urgency
            ')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Format untuk ApexCharts
        $months = [];
        $totalAssessments = [];
        $avgScores = [];
        $highUrgency = [];
        $mediumUrgency = [];
        $lowUrgency = [];

        foreach ($data as $item) {
            $monthName = \DateTime::createFromFormat('!m', $item->month)->format('M');
            $months[] = $monthName . ' ' . $item->year;
            $totalAssessments[] = $item->total_assessment;
            $avgScores[] = round($item->avg_score, 2);
            $highUrgency[] = $item->high_urgency;
            $mediumUrgency[] = $item->medium_urgency;
            $lowUrgency[] = $item->low_urgency;
        }

        return response()->json([
            'success' => true,
            'months' => $months,
            'series' => [
                [
                    'name' => 'Rata-rata Skor Urgensi (%)',
                    'data' => $avgScores,
                ],
                [
                    'name' => 'Total Asesmen',
                    'data' => $totalAssessments,
                ],
            ],
            'breakdown' => [
                [
                    'name' => 'Urgensi Tinggi (≥80%)',
                    'data' => $highUrgency,
                ],
                [
                    'name' => 'Urgensi Sedang (50-79%)',
                    'data' => $mediumUrgency,
                ],
                [
                    'name' => 'Urgensi Rendah (<50%)',
                    'data' => $lowUrgency,
                ],
            ],
        ]);
    }

    /**
     * Get category distribution
     * Returns data for pie chart: Distribusi Kasus per Kategori Gejala
     */
    public function categoryDistribution(): JsonResponse
    {
        $this->checkAdmin();
        
        // Join assessment_details dengan symptoms untuk mendapatkan kategori
        $data = DB::table('assessment_details')
            ->join('symptoms', 'assessment_details.symptom_id', '=', 'symptoms.id')
            ->selectRaw('symptoms.category, COUNT(DISTINCT assessment_details.assessment_id) as total_assessment')
            ->groupBy('symptoms.category')
            ->orderByDesc('total_assessment')
            ->get();

        $categories = [];
        $values = [];
        $colors = ['#0D9488', '#14B8A6', '#2DD4BF', '#99F6E4', '#CCFBF1', '#F0FDFA'];

        foreach ($data as $item) {
            $categories[] = $item->category;
            $values[] = $item->total_assessment;
        }

        return response()->json([
            'success' => true,
            'labels' => $categories,
            'series' => $values,
            'colors' => $colors,
        ]);
    }

    /**
     * Get status summary
     * Returns data for bar chart: Summary Status Penanganan
     */
    public function statusSummary(): JsonResponse
    {
        $this->checkAdmin();
        
        // Define semua status yang mungkin ada
        $allStatuses = ['Belum Diproses', 'Menunggu Jadwal', 'Sedang Konseling', 'Selesai'];
        
        // Query data dari database
        $data = Assessment::selectRaw('
                status,
                COUNT(*) as total,
                AVG(final_score) as avg_score
            ')
            ->groupBy('status')
            ->get()
            ->keyBy('status');

        $statuses = [];
        $totals = [];
        $avgScores = [];

        // Iterasi semua status yang mungkin, isi dengan 0 jika tidak ada data
        foreach ($allStatuses as $status) {
            $statuses[] = $status;
            
            if (isset($data[$status])) {
                $totals[] = $data[$status]->total;
                $avgScores[] = round($data[$status]->avg_score, 2);
            } else {
                $totals[] = 0;
                $avgScores[] = 0;
            }
        }

        return response()->json([
            'success' => true,
            'statuses' => $statuses,
            'totals' => $totals,
            'avgScores' => $avgScores,
        ]);
    }

    /**
     * Get overall dashboard statistics
     * Returns summary numbers for dashboard cards
     */
    public function dashboardStats(): JsonResponse
    {
        $this->checkAdmin();
        
        $totalAssessments = Assessment::count();
        $totalStudents = Assessment::distinct('user_id')->count();
        $avgUrgency = Assessment::avg('final_score');
        $highUrgencyCount = Assessment::where('final_score', '>=', 80)->count();
        $completedStatus = Assessment::where('status', 'Selesai')->count();

        return response()->json([
            'success' => true,
            'total_assessments' => $totalAssessments,
            'total_students' => $totalStudents,
            'avg_urgency' => round($avgUrgency, 2),
            'high_urgency_count' => $highUrgencyCount,
            'high_urgency_percentage' => $totalAssessments > 0 ? round(($highUrgencyCount / $totalAssessments) * 100, 1) : 0,
            'completed_count' => $completedStatus,
            'completion_rate' => $totalAssessments > 0 ? round(($completedStatus / $totalAssessments) * 100, 1) : 0,
        ]);
    }

    /**
     * Get dominant category analysis
     * Returns data for analysis: Kategori Dominan Asesmen
     */
    public function dominantCategoryAnalysis(): JsonResponse
    {
        $this->checkAdmin();
        
        $data = Assessment::selectRaw('
                dominant_category,
                COUNT(*) as total_assessment,
                AVG(final_score) as avg_score,
                COUNT(CASE WHEN status = "Selesai" THEN 1 END) as completed
            ')
            ->where('dominant_category', '!=', null)
            ->groupBy('dominant_category')
            ->orderByDesc('total_assessment')
            ->get();

        $categories = [];
        $totals = [];
        $avgScores = [];
        $completed = [];

        foreach ($data as $item) {
            $categories[] = $item->dominant_category;
            $totals[] = $item->total_assessment;
            $avgScores[] = round($item->avg_score, 2);
            $completed[] = $item->completed;
        }

        return response()->json([
            'success' => true,
            'categories' => $categories,
            'totals' => $totals,
            'avgScores' => $avgScores,
            'completed' => $completed,
        ]);
    }
}
