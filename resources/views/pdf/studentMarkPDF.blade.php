<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $project->project_name }} | Student Marks Report</title>
    <style>
        @page {
            size: A4 landscape; /* Forces landscape mode */
            margin: 20px;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 10px;
            padding: 10px;
        }
        h2 {
            color: #2c3e50;
            text-align: center;
            margin: 0 0 0 0;
            font-size: 16pt;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        h4 {
            color: #2c3e50;
            text-align: center;
            margin: 0 0 1cm 0;
            font-size: 12pt;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .pending {
            color: #e74c3c;
            font-weight: bold;
        }
        .name {
            width: 15%;
            word-wrap: break-word;
            text-align: left;
        }
    </style>
    
</head>
<body>

<h2>{{ $project->project_name }}</h2>
<h4>Student Marks Report</h4>

<table>
    <thead>
        <tr>
            <th>Student Name</th>
            <th>Lecturer Marks (20%)</th>
            <th>Assessor Marks (15%)</th>
            <th>Peers Marks (15%)</th>
            <th>Total Marks (50%)</th>
            <th class="feedback">Feedback from Assessor</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($students as $student)
            <tr>
                <td class="name">{{ $student->users->name }}</td>
                <td class="{{ $student->lecturer_score == null ? 'pending' : '' }}">
                    {{ $student->lecturer_score ?? 'Pending Evaluation' }}
                </td>
                <td class="{{ $student->assessor_score == null ? 'pending' : '' }}">
                    {{ $student->assessor_score ?? 'Pending Evaluation' }}
                </td>
                <td class="{{ $student->is_evaluated == false ? 'pending' : '' }}">
                    {{ $student->is_evaluated ? $student->calc_peers_score : 'Pending Evaluation' }}
                </td>
                <td class="{{ ($student->lecturer_score == null || $student->assessor_score == null || $student->is_evaluated == false) ? 'pending' : '' }}">
                    {{ ($student->lecturer_score == null || $student->assessor_score == null || $student->is_evaluated == false) ? 'Pending Evaluation' : $student->total_marks }}
                </td>
                <td class="feedback">{{ $student->assessor_comment }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">No data</td>
            </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>