    <style>
        body{
            font-family: serif;
            font-size: 12px;
        }

        h2{
            text-align: center;
            margin-bottom: 5px;
        }

        p{
            text-align: center;
            margin: 2px 0;
        }

        table{
            width:100%;
            border-collapse: collapse;
            margin-top:20px;
        }

        table, th, td{
            border:1px solid black;
        }

        th, td{
            padding:5px;
        }

        th{
            background:#d9d9d9;
        }
    </style>
    <div style="text-align:center;">
        <h2 style="margin:0;">Data User</h2>
        <p>Di Cetak : {{ $tanggal }}</p>
        <p>Jam : {{ $jam }}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Jabatan</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->jabatan }}</td>
                <td>{{ $user->is_tugas ? 'Sudah Ditugaskan' : 'Belum Ditugaskan' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>