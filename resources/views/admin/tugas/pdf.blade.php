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
        <h2 style="margin:0;">Data Tugas</h2>
        <p>Di Cetak : {{ $tanggal }}</p>
        <p>Jam : {{ $jam }}</p>
    </div>
    <hr>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Tugas</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
            </tr>
        </thead>

        <tbody>
            @foreach($tugas as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->user->email }}</td>
                <td>{{ $item->tugas }}</td>
                <td>{{ $item->tanggal_mulai }}</td>
                <td>{{ $item->tanggal_selesai }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <hr>