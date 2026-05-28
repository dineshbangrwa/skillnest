<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        $query = Newsletter::query();

        // Search by email
        if ($request->has('search') && $request->search) {
            $query->where('email', 'like', '%'.$request->search.'%');
        }

        // Filter by subscription status
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_subscribed', (bool) $request->status);
        }

        $newsletters = $query->orderBy('subscribed_at', 'desc')->paginate(15);

        return view('admin.newsletters.index', compact('newsletters'));
    }

    public function show(Newsletter $newsletter)
    {
        return view('admin.newsletters.show', compact('newsletter'));
    }

    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();

        return redirect()->route('admin.newsletters.index')->with('status', 'Newsletter subscriber deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->validate(['ids' => 'required|array'])['ids'];

        Newsletter::whereIn('id', $ids)->delete();

        return redirect()->route('admin.newsletters.index')->with('status', 'Selected subscribers deleted successfully.');
    }

    public function export()
    {
        $newsletters = Newsletter::where('is_subscribed', true)
            ->select('email', 'subscribed_at')
            ->get();

        $filename = 'newsletter_subscribers_'.date('Y-m-d_H-i-s').'.csv';

        $handle = fopen('php://memory', 'r+');
        fputcsv($handle, ['Email', 'Subscribed At']);

        foreach ($newsletters as $newsletter) {
            fputcsv($handle, [
                $newsletter->email,
                $newsletter->subscribed_at->format('Y-m-d H:i:s'),
            ]);
        }

        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }
}
