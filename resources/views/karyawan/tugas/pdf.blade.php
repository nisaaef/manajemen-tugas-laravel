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
        }

        table, th, td{
            border:none;
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
    <table width="100%">
        <tbody>
            <tr>
                <td>Nama</td>
                <td>:{{ $tugas->user->name }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:{{ $tugas->user->email }}</td>
            </tr>
            <tr>
                <td>Tugas</td>
                <td>:{{ $tugas->tugas }}</td>
            </tr>
            <tr>
                <td>Tanggal Mulai</td>
                <td>:{{ $tugas->tanggal_mulai }}</td>
            </tr>
            <tr>
                <td>Tanggal Selesai</td>
                <td>:{{ $tugas->tanggal_selesai }}</td>
            </tr>
        </tbody>
    </table>
    <hr>