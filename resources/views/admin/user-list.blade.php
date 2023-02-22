@extends("layouts.app")
@section("content")
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 10px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
    <div class="container">
        <div class="btn-toolbar">
            <div class="btn-group ml-4 justify-content-end" style="margin-right: 10px;">
                <select id="filtered_role" name="filtered_role" class="form-select form-select-sm"
                        aria-label="Select Role">
                    @if($role === 'ALL')
                        <option selected value="ALL">ALL ROLE</option>
                    @else
                        <option value="ALL">ALL ROLE</option>
                    @endif
                    @if($role === 'USER')
                        <option selected value="USER">USER</option>
                    @else
                        <option value="USER">USER</option>
                    @endif
                    @if($role === 'ADMIN')
                        <option selected value="ADMIN">ADMIN</option>
                    @else
                        <option value="ADMIN">ADMIN</option>
                    @endif
                </select>
            </div>
            <div class="btn-group ml-4" >
                <a id="link" href="#" class="btn btn-sm btn-primary">
                    <i class="bi bi-search"></i>&nbsp;SEARCH
                </a>
            </div>
        </div>
        <div style="margin-top: 10px;">
            <table>
                <tr>
                    <th style="text-align: center;">#</th>
                    <th style="text-align: center;">ID</th>
                    <th style="text-align: center;">Name</th>
                    <th style="text-align: center;">Email</th>
                    <th style="text-align: center;">Role</th>
                    <th style="text-align: center;">Created Date</th>
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td style="text-align: center;">{{ ($loop->index) + 1 }}.</td>
                        <td style="text-align: center;">{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td style="text-align: center;">{{ $user->role }}</td>
                        <td style="text-align: center;">{{ $user->created_at }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $users->links() }}
        </div>
    </div>
    <script>
        $("#filtered_role").on('change', function () {
            var filteredRole = this.value;
            $('#link').attr('href', '/users/get-user-list/admin/filter/' + filteredRole);
        });
    </script>
@endsection
