<div class="flex items-center justify-between">
    <h5>Earnings revenue</h5>
    <div class="dropdown default">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <span class="icon-more"><i class="icon-more-horizontal"></i></span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a href="{{ route('user.dashboard') }}">This year</a>
            </li>
            <li>
                <a href="{{ route('last.week.data') }}">Last Week</a>
            </li>
            <li>
                <a href="{{ route('last.month.data') }}">Last Month</a>
            </li>
            <li>
                <a href="{{ route('last.year.data') }}">Last Year</a>
            </li>
        </ul>
    </div>
</div>
