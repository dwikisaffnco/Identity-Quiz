<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuizResult;
use Illuminate\Http\Request;

class QuizResultController extends Controller
{
    public function index()
    {
        $totalResponses = QuizResult::count();
        $results = QuizResult::with('user')->orderBy('created_at', 'desc')->paginate(25);

        return view('admin.dashboard', compact('results', 'totalResponses'));
    }

    public function show(QuizResult $quizResult)
    {
        return view('admin.quiz_result_show', ['result' => $quizResult]);
    }

    public function edit(QuizResult $quizResult)
    {
        return view('admin.quiz_result_edit', ['result' => $quizResult]);
    }

    public function update(Request $request, QuizResult $quizResult)
    {
        $validated = $request->validate([
            'q1' => 'nullable|string',
            'q2' => 'nullable|string',
            'q3' => 'nullable|string',
            'q4' => 'nullable|string',
            'q5' => 'nullable|string',
            'q6' => 'nullable|string',
            'final_category' => 'nullable|string',
            'final_category_name' => 'nullable|string',
        ]);

        $quizResult->update($validated);

        return redirect()->route('admin.quiz_results.show', $quizResult->id)
                       ->with('success', 'Result updated successfully');
    }

    public function destroy(QuizResult $quizResult)
    {
        $quizResult->delete();

        return response()->json(['ok' => true, 'message' => 'Result deleted successfully']);
    }

    public function export()
    {
        $results = QuizResult::with('user')->orderBy('created_at', 'desc')->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="quiz_results_'.now()->format('Ymd_His').'.csv"',
        ];

        $callback = function () use ($results) {
            $handle = fopen('php://output', 'w');

            // Header row
            fputcsv($handle, [
                'ID',
                'User Email',
                'Q1',
                'Q2',
                'Q3',
                'Q4',
                'Q5',
                'Q6',
                'Score A',
                'Score B',
                'Score C',
                'Score D',
                'Score E',
                'Final Category',
                'Final Category Name',
                'Created At',
            ]);

            foreach ($results as $r) {
                fputcsv($handle, [
                    $r->id,
                    optional($r->user)->email ?? 'Guest',
                    $r->q1,
                    $r->q2,
                    $r->q3,
                    $r->q4,
                    $r->q5,
                    $r->q6,
                    $r->score_a,
                    $r->score_b,
                    $r->score_c,
                    $r->score_d,
                    $r->score_e,
                    $r->final_category,
                    $r->final_category_name,
                    optional($r->created_at)->toDateTimeString(),
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportToSheets()
    {
        $results = QuizResult::with('user')->orderBy('created_at', 'asc')->get();

        if ($results->isEmpty()) {
            return response()->json([
                'ok' => false,
                'message' => 'No results to send',
            ], 400);
        }

        $googleScriptUrl = 'https://script.google.com/macros/s/AKfycbxmZcHytVA3jZHFxd_z3smotv9n2BYFXnvdjnUdRuYHt17h4xbLrppitdt7zyrNRUTFlA/exec';

        try {
            foreach ($results as $r) {
                $payload = [
                    'Q1' => $r->q1,
                    'Q2' => $r->q2,
                    'Q3' => $r->q3,
                    'Q4' => $r->q4,
                    'Q5' => $r->q5,
                    'Q6' => $r->q6,
                    'ScoreA' => $r->score_a,
                    'ScoreB' => $r->score_b,
                    'ScoreC' => $r->score_c,
                    'ScoreD' => $r->score_d,
                    'ScoreE' => $r->score_e,
                    'FinalCategory' => $r->final_category,
                    'FinalCategoryName' => $r->final_category_name,
                    'RollingList' => $r->rolling_list,
                    'UserEmail' => optional($r->user)->email ?? 'Guest',
                    'Timestamp' => optional($r->created_at)->toDateTimeString(),
                ];

                $ch = curl_init($googleScriptUrl);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                curl_exec($ch);
                curl_close($ch);
            }

            return response()->json([
                'ok' => true,
                'message' => 'All results sent to Google Sheets.',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'ok' => false,
                'message' => 'Failed to send data to Google Sheets.',
            ], 500);
        }
    }
}
