<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    /**
     * Display activity logs
     */
    public function index(Request $request)
    {
        $query = Activity::with(['causer', 'subject']);

        // Filter by log name (module)
        $logName = $request->get('log_name', 'all');
        if ($logName !== 'all') {
            $query->where('log_name', $logName);
        }

        // Filter by date
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Filter by user
        if ($request->filled('user_id')) {
            $query->where('causer_id', $request->user_id);
        }

        // Filter by search (description or subject)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                    ->orWhere('subject_type', 'like', "%{$search}%");
            });
        }

        $logs = $query->latest()->paginate(20);

        // Get available log names for filter
        $logNames = Activity::distinct('log_name')
            ->pluck('log_name')
            ->sort();

        return view('admin.activity-logs.index', compact('logs', 'logNames'));
    }

    /**
     * Show detailed activity log
     */
    public function show(Activity $activity)
    {
        $activity->load(['causer', 'subject']);

        return view('admin.activity-logs.show', compact('activity'));
    }

    /**
     * Clear old logs
     */
    public function clearOldLogs(Request $request)
    {
        $days = $request->get('days', 30);

        $deleted = Activity::where('created_at', '<', now()->subDays($days))
            ->delete();

        return redirect()->back()
            ->with('success', "{$deleted} log lama berhasil dihapus");
    }
}
