<?php
header("Content-Type: application/json");

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "pertanian");
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Mendapatkan method HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Routing berdasarkan method
switch ($method) {
    case 'GET':
        // READ - Ambil data
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = $conn->prepare("SELECT * FROM alat WHERE id = ?");
            $query->bind_param("i", $id);
        } else {
            $query = $conn->prepare("SELECT * FROM alat");
        }
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($data);
        break;

    case 'POST':
        // CREATE - Tambah data
        $input = json_decode(file_get_contents("php://input"), true);
        $nama = $input['nama'];
        $bahan = $input['bahan'];
        $alat = $input['alat'];

        $query = $conn->prepare("INSERT INTO alat (nama, bahan, alat) VALUES (?, ?, ?)");
        $query->bind_param("sss", $nama, $bahan, $alat);

        if ($query->execute()) {
            echo json_encode([
                "success" => true,
                "message" => "Data berhasil ditambahkan",
                "id" => $conn->insert_id
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "error" => $query->error
            ]);
        }
        break;

    case 'PUT':
        // UPDATE - Ubah data
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $input = json_decode(file_get_contents("php://input"), true);
            $nama = $input['nama'];
            $bahan = $input['bahan'];
            $alat = $input['alat'];

            $query = $conn->prepare("UPDATE alat SET nama = ?, bahan = ?, alat = ? WHERE id = ?");
            $query->bind_param("sssi", $nama, $bahan, $alat, $id);

            if ($query->execute()) {
                echo json_encode([
                    "success" => true,
                    "message" => "Data berhasil diubah"
                ]);
            } else {
                echo json_encode([
                    "success" => false,
                    "error" => $query->error
                ]);
            }
        } else {
            echo json_encode([
                "success" => false,
                "message" => "ID tidak ditemukan"
            ]);
        }
        break;

    case 'DELETE':
        // DELETE - Hapus data
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = $conn->prepare("DELETE FROM alat WHERE id = ?");
            $query->bind_param("i", $id);

            if ($query->execute()) {
                echo json_encode([
                    "success" => true,
                    "message" => "Data berhasil dihapus"
                ]);
            } else {
                echo json_encode([
                    "success" => false,
                    "error" => $query->error
                ]);
            }
        } else {
            echo json_encode([
                "success" => false,
                "message" => "ID tidak ditemukan"
            ]);
        }
        break;

    default:
        echo json_encode(["error" => "Method tidak didukung"]);
        break;
}

$conn->close();
?>
