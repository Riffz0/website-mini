<?php
include('../koneksi.php');

// Filter data berdasarkan pencarian
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM pendaftar WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR sport LIKE '%$search%'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold text-center mb-6">Daftar Pendaftar</h2>

        <!-- Form Pencarian -->
        <form method="GET" class="flex justify-center mb-6">
            <input 
                type="text" 
                name="search" 
                value="<?= htmlspecialchars($search) ?>" 
                placeholder="Cari nama, email, atau cabang olahraga" 
                class="w-2/3 md:w-1/3 p-2 border border-gray-300 rounded-l"
            >
            <button 
                type="submit" 
                class="bg-blue-500 text-white px-4 py-2 rounded-r hover:bg-blue-700 transition"
            >
                Cari
            </button>
        </form>

        <!-- Tabel Data -->
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Nama</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Telepon</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Cabang Olahraga</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2"><?= $row['id'] ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= $row['name'] ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= $row['email'] ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= $row['phone'] ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= $row['sport'] ?></td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <div class="flex justify-center space-x-2">
                                        <a href="update.php?id=<?= $row['id'] ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Edit</a>
                                        <a href="delete.php?id=<?= $row['id'] ?>" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 transition">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="border border-gray-300 px-4 py-2 text-center">Tidak ada data yang ditemukan</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
