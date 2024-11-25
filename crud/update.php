<?php
include('../koneksi.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM pendaftar WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan!";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sport = $_POST['sport'];

    $sql = "UPDATE pendaftar SET name = '$name', email = '$email', phone = '$phone', sport = '$sport' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>

    <style>
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #555;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .radio-group {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .submit-btn {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>  
<div class="form-container">
        <h2>Edit Pendaftaran</h2>
        <form action="update.php" method="POST">

            <input type="hidden" name="id" value="<?= $row['id'] ?>">

            <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="<?= $row['name'] ?>" required>
            </div>

            <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?= $row['email'] ?>" required>
            </div>

            <div class="form-group">
            <label>Telepon</label>
            <input type="text" name="phone" value="<?= $row['phone'] ?>" required>
            </div>

            <div class="form-group">
            <label>Cabang Olahraga</label>
                <select id="sport" name="sport" required>
                    <option value="">Pilih cabang</option>
                    <option <?= $row['sport'] == 'Sepak Bola' ? 'selected' : '' ?>>Sepak Bola</option>
                    <option <?= $row['sport'] == 'Basket' ? 'selected' : '' ?>>Basket</option>
                    <option <?= $row['sport'] == 'Bulu Tangkis' ? 'selected' : '' ?>>Bulu Tangkis</option>
                </select>
            </div>
            <br></br>

            <button type="submit" class="submit-btn">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
