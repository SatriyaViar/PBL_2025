<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accreditation DA Business Information System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .header {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: white;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        .logo {
            display: flex;
            align-items: center;
            font-weight: bold;
            font-size: 16px;
        }

        .logo::before {
            content: "🏛️";
            margin-right: 10px;
            font-size: 20px;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 30px;
        }

        .nav-menu a {
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .nav-menu a:hover {
            background-color: rgba(255,255,255,0.1);
        }

        .login-btn {
            background-color: #3498db;
            color: white;
            padding: 8px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-btn:hover {
            background-color: #2980b9;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .page-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        .section {
            background: linear-gradient(135deg, #6c7b7f, #8a9399);
            border-radius: 8px;
            margin-bottom: 30px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .section-header {
            background-color: rgba(0,0,0,0.1);
            color: white;
            padding: 15px 20px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-header {
            background: linear-gradient(135deg, #34495e, #2c3e50);
            color: white;
        }

        .table-header th {
            padding: 15px 20px;
            text-align: left;
            font-weight: bold;
            border-right: 1px solid rgba(255,255,255,0.1);
        }

        .table-header th:last-child {
            border-right: none;
        }

        .table-row {
            border-bottom: 1px solid rgba(255,255,255,0.1);
            transition: background-color 0.3s;
        }

        .table-row:hover {
            background-color: rgba(255,255,255,0.05);
        }

        .table-row:last-child {
            border-bottom: none;
        }

        .table-cell {
            padding: 15px 20px;
            color: white;
            border-right: 1px solid rgba(255,255,255,0.1);
        }

        .table-cell:last-child {
            border-right: none;
        }

        .link {
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
        }

        .link:hover {
            text-decoration: underline;
        }

        .footer {
            background: linear-gradient(135deg, #2c3e50, #34495e);
            color: white;
            padding: 30px 0;
            margin-top: 50px;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .footer-links {
            display: flex;
            gap: 30px;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: #3498db;
        }

        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 15px;
            }

            .nav-menu {
                flex-wrap: wrap;
                gap: 15px;
            }

            .footer-content {
                flex-direction: column;
                gap: 20px;
            }

            .table-cell, .table-header th {
                padding: 10px 15px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="nav-container">
            <div class="logo">Accreditation DA Business Information System</div>
            <nav>
                <ul class="nav-menu">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#accreditation">Accreditation</a></li>
                    <li><a href="#criteria">Criteria ▼</a></li>
                    <li><a href="#information">Information</a></li>
                </ul>
            </nav>
            <button class="login-btn">Login</button>
        </div>
    </header>

    <div class="container">
        <h1 class="page-title">Criteria - 1</h1>

        <!-- PENETAPAN Section -->
        <div class="section">
            <div class="section-header">PENETAPAN</div>
            <table class="table">
                <thead class="table-header">
                    <tr>
                        <th>No</th>
                        <th>Support Data Name</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-row">
                        <td class="table-cell">1</td>
                        <td class="table-cell">Statuta</td>
                        <td class="table-cell"><a href="#" class="link">https://</a></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-cell">2</td>
                        <td class="table-cell">Surat Tugas</td>
                        <td class="table-cell"><a href="#" class="link">https://</a></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-cell">3</td>
                        <td class="table-cell">SK penetapan</td>
                        <td class="table-cell"><a href="#" class="link">https://</a></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-cell">4</td>
                        <td class="table-cell">Renstra Politeknik</td>
                        <td class="table-cell"><a href="#" class="link">https://</a></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-cell">5</td>
                        <td class="table-cell">Dokumen Visi</td>
                        <td class="table-cell"><a href="#" class="link">https://</a></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- PELAKSANAAN Section -->
        <div class="section">
            <div class="section-header">PELAKSANAAN</div>
            <table class="table">
                <thead class="table-header">
                    <tr>
                        <th>No</th>
                        <th>Support Data Name</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-row">
                        <td class="table-cell">1</td>
                        <td class="table-cell">Statuta</td>
                        <td class="table-cell"><a href="#" class="link">https://</a></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-cell">2</td>
                        <td class="table-cell">Surat Tugas</td>
                        <td class="table-cell"><a href="#" class="link">https://</a></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-cell">3</td>
                        <td class="table-cell">SK penetapan</td>
                        <td class="table-cell"><a href="#" class="link">https://</a></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-cell">4</td>
                        <td class="table-cell">Renstra Politeknik</td>
                        <td class="table-cell"><a href="#" class="link">https://</a></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-cell">5</td>
                        <td class="table-cell">Dokumen Visi</td>
                        <td class="table-cell"><a href="#" class="link">https://</a></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- EVALUASI Section -->
        <div class="section">
            <div class="section-header">EVALUASI</div>
            <table class="table">
                <thead class="table-header">
                    <tr>
                        <th>No</th>
                        <th>Support Data Name</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-row">
                        <td class="table-cell">1</td>
                        <td class="table-cell">Statuta</td>
                        <td class="table-cell"><a href="#" class="link">https://</a></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-cell">2</td>
                        <td class="table-cell">Surat Tugas</td>
                        <td class="table-cell"><a href="#" class="link">https://</a></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-cell">3</td>
                        <td class="table-cell">SK penetapan</td>
                        <td class="table-cell"><a href="#" class="link">https://</a></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-cell">4</td>
                        <td class="table-cell">Renstra Politeknik</td>
                        <td class="table-cell"><a href="#" class="link">https://</a></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-cell">5</td>
                        <td class="table-cell">Dokumen Visi</td>
                        <td class="table-cell"><a href="#" class="link">https://</a></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- PENGENDALIAN Section -->
        <div class="section">
            <div class="section-header">PENGENDALIAN</div>
            <table class="table">
                <thead class="table-header">
                    <tr>
                        <th>No</th>
                        <th>Support Data Name</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-row">
                        <td class="table-cell">1</td>
                        <td class="table-cell">Statuta</td>
                        <td class="table-cell"><a href="#" class="link">https://</a></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-cell">2</td>
                        <td class="table-cell">Surat Tugas</td>
                        <td class="table-cell"><a href="#" class="link">https://</a></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-cell">3</td>
                        <td class="table-cell">SK penetapan</td>
                        <td class="table-cell"><a href="#" class="link">https://</a></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-cell">4</td>
                        <td class="table-cell">Renstra Politeknik</td>
                        <td class="table-cell"><a href="#" class="link">https://</a></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-cell">5</td>
                        <td class="table-cell">Dokumen Visi</td>
                        <td class="table-cell"><a href="#" class="link">https://</a></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- PENINGKATAN Section -->
        <div class="section">
            <div class="section-header">PENINGKATAN</div>
            <table class="table">
                <thead class="table-header">
                    <tr>
                        <th>No</th>
                        <th>Support Data Name</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-row">
                        <td class="table-cell">1</td>
                        <td class="table-cell">Statuta</td>
                        <td class="table-cell"><a href="#" class="link">https://</a></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-cell">2</td>
                        <td class="table-cell">Surat Tugas</td>
                        <td class="table-cell"><a href="#" class="link">https://</a></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-cell">3</td>
                        <td class="table-cell">SK penetapan</td>
                        <td class="table-cell"><a href="#" class="link">https://</a></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-cell">4</td>
                        <td class="table-cell">Renstra Politeknik</td>
                        <td class="table-cell"><a href="#" class="link">https://</a></td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-cell">5</td>
                        <td class="table-cell">Dokumen Visi</td>
                        <td class="table-cell"><a href="#" class="link">https://</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <div>© Politeknik Student 2025</div>
            <div class="footer-links">
                <a href="#website">Politeknik Website</a>
                <a href="#instagram">Instagram</a>
                <a href="#contact">Contact</a>
            </div>
        </div>
    </footer>
</body>
</html>
