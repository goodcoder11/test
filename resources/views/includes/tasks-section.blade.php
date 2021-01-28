<div id="tasks" class="col-md-12" style="margin-top: 20px;">
    <div class="card">
        <div class="card-header text-center">{{ __('All Tasks') }}</div>

        <div class="card-body">
            <form method="get" action="{{ request()->url() }}#tasks">
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-6">
                        <label>Sort By</label>
                        <select class="form-control" name="sort_field">
                            <option value="">-- Select An Item -- </option>
                            <option @if(request('sort_field') == 'user_name') selected @endif value="user_name">User Name</option>
                            <option @if(request('sort_field') == 'email') selected @endif value="email">User Email</option>
                            <option @if(request('sort_field') == 'status') selected @endif value="status">Status</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Select Direction</label>
                        <select class="form-control" name="sort_direction">
                            <option @if(request('sort_direction') == 'asc') selected @endif value="asc">A-Z, 0-9</option>
                            <option @if(request('sort_direction') == 'desc') selected @endif value="desc">Z-A, 9-0</option>
                        </select>
                    </div>
                    <div class="col-md-2" style="align-self: flex-end;">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>

            <table class="table">
                <thead>
                <tr>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Text</th>
                    <th>Status</th>
                    <th>Created at</th>
                    @if (isset($allowCB) && $allowCB === true)
                        <th>Is Guest?</th>
                        <th>Change Status</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @if($countTasks)
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->user_name }}</td>
                            <td>{{ $task->email }}</td>
                            <td>{{ $task->text }}</td>
                            <td class="task-status-info-{{ $task->id }}" style="color: #0a4285;">{{ $task->status ? 'отредактировано администратором' : 'не проверено' }}</td>
                            <td>{{ $task->created_at }}</td>
                            @if (isset($allowCB) && $allowCB === true)
                                <th>{{ $task->user_id ? 'No' : 'Yes' }}</th>
                                <td class="tasks-cb-td">
                                   <label>
                                       Update Status
                                       <input type="checkbox" data-id="{{ $task->id }}" @if($task->status == 1) checked @endif />
                                   </label>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>
                            <h1>No data found.</h1>
                        </td>
                    </tr>
                @endif
                </tbody>
                <tfoot>
                <tr>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Text</th>
                    <th>Status</th>
                    <th>Created at</th>
                    @if (isset($allowCB) && $allowCB === true)
                        <th>Is Guest?</th>
                        <th>Change Status</th>
                    @endif
                </tr>
                </tfoot>
            </table>

            {{ $tasks->withQueryString()->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
