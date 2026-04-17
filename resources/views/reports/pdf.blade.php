<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rapor Summary</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background: #f3f4f6; }
    </style>
</head>
<body>
    <h2>Ringkasan Rapor Siswa</h2>
    <p>Generated at: {{ $generatedAt->format('Y-m-d H:i:s') }}</p>
    <table>
        <thead>
            <tr>
                <th>Siswa</th>
                <th>Mapel</th>
                <th>Semester</th>
                <th>Tahun Ajaran</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reports as $report)
                <tr>
                    <td>{{ $report->student->full_name ?? '-' }}</td>
                    <td>{{ $report->subject->name ?? '-' }}</td>
                    <td>{{ $report->semester }}</td>
                    <td>{{ $report->academic_year }}</td>
                    <td>{{ $report->score }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada data rapor.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
