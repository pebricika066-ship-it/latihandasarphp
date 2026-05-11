$user = "admin";
$pass = "1234";

$u = $_POST['user'];
$p = $_POST['pass'];

if ($u == $user && $p == $pass) {
    echo "Login sukses";
} else {
    echo "Login gagal";
}