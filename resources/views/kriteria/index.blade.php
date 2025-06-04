@extends('layouts.app') <!-- Sesuaikan dengan layout utama kamu -->

@section('content')
<div class="container my-5">

    <div class="bg-secondary text-white p-4 rounded" style="background-color: #291911;">
        <h5>Criteria 1</h5>
        <div class="table-responsive">
            <table class="table table-bordered text-white">
                <thead class="bg-dark">
                    <tr>
                        <th>No</th>
                        <th>Support Data Name</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Statua</td>
                        <td><a href="https://" class="text-white" target="_blank">https://</a></td>
                    </tr>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container my-5">

    <div class="bg-secondary text-white p-4 rounded" style="background-color: #5c6670;">
        <h5 class="mb-3">Criteria 2</h5>
        <div class="table-responsive">
            <table class="table table-bordered text-white">
                <thead class="bg-dark">
                    <tr>
                        <th>No</th>
                        <th>Support Data Name</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Statua</td>
                        <td><a href="https://" class="text-white" target="_blank">https://</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
