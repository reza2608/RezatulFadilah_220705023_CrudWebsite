<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>CRUD System</title>
</head>
<body>
    <div class="container">
        <h2>Daftar Pengguna</h2>
        <a href="create.php" class="btn">Tambah Pengguna Baru</a>

        <!-- Form Pencarian -->
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Cari pengguna berdasarkan nama">
            <button type="submit">Cari</button>
        </form>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Koneksi ke database
                    $conn = new mysqli("localhost", "root", "", "crud_db");
                    if ($conn->connect_error) {
                        die("Koneksi gagal: " . $conn->connect_error);
                    }

                    // Mendapatkan kata kunci pencarian jika ada
                    $search = isset($_GET['search']) ? $_GET['search'] : '';

                    // Menyiapkan query untuk mengambil data pengguna berdasarkan pencarian nama
                    if ($search) {
                        $sql = "SELECT * FROM users WHERE name LIKE '%$search%'";
                    } else {
                        $sql = "SELECT * FROM users";
                    }

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["phone"] . "</td>";
                            echo "<td>
                                    <a href='update.php?id=" . $row["id"] . "' class='btn-edit'>Edit</a>
                                    <a href='delete.php?id=" . $row["id"] . "' class='btn-delete' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>