<?php
require_once 'db.php';

// จัดการการลบข้อมูล (Delete)
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // ดึงชื่อไฟล์รูปภาพเก่ามาลบออกจากโฟลเดอร์ก่อน
    $stmtImg = $pdo->prepare("SELECT image FROM foods WHERE id = ?");
    $stmtImg->execute([$delete_id]);
    $oldFood = $stmtImg->fetch();
    if ($oldFood && !empty($oldFood['image']) && file_exists('uploads/' . $oldFood['image'])) {
        unlink('uploads/' . $oldFood['image']);
    }

    // ลบวัตถุดิบลูกก่อนป้องกัน Error Foreign Key
    $pdo->prepare("DELETE FROM recipes WHERE food_id = ?")->execute([$delete_id]);

    $stmt = $pdo->prepare("DELETE FROM foods WHERE id = ?");
    $stmt->execute([$delete_id]);
    header("Location: index.php");
    exit;
}

// รับค่าค้นหา
$search = $_GET['search'] ?? '';

// ดึงข้อมูลอาหารพร้อมวัตถุดิบ + เขียนเงื่อนไขค้นหา (ชื่ออาหาร, หมวดหมู่, วัตถุดิบ)
$sql = "SELECT f.*, r.recipe_name, r.quantity, r.unit_name 
        FROM foods f 
        LEFT JOIN recipes r ON f.id = r.food_id ";

if (!empty($search)) {
    $sql .= " WHERE f.name_th LIKE ? OR f.category LIKE ? OR r.recipe_name LIKE ? ";
}
$sql .= " ORDER BY f.id DESC";

$stmt = $pdo->prepare($sql);

if (!empty($search)) {
    $search_param = "%$search%";
    $stmt->execute([$search_param, $search_param, $search_param]);
} else {
    $stmt->execute();
}
$rows = $stmt->fetchAll();

// จัดกลุ่มข้อมูลอาหาร
$foods = [];
foreach ($rows as $row) {
    $food_id = $row['id'];
    if (!isset($foods[$food_id])) {
        $foods[$food_id] = [
            'id' => $row['id'],
            'name_th' => $row['name_th'],
            'category' => $row['category'],
            'image' => $row['image'],
            'recipes' => []
        ];
    }
    if ($row['recipe_name']) {
        $foods[$food_id]['recipes'][] = [
            'recipe_name' => $row['recipe_name'],
            'quantity' => $row['quantity'],
            'unit_name' => $row['unit_name']
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>ระบบจัดการข้อมูลอาหารและสูตรอาหาร</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-secondary">📋 รายการเมนูอาหารทั้งหมด</h2>
            <a href="manage.php" class="btn btn-primary">+ เพิ่มเมนูอาหารใหม่</a>
        </div>

        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form action="index.php" method="GET" class="row g-2">
                    <div class="col-md-9">
                        <input type="text" name="search" class="form-control"
                            placeholder="ค้นหาด้วยชื่ออาหาร, หมวดหมู่ หรือวัตถุดิบ..."
                            value="<?= htmlspecialchars($search) ?>">
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-secondary w-100">🔍 ค้นหา</button>
                        <?php if (!empty($search)): ?>
                            <a href="index.php" class="btn btn-outline-secondary">ล้างค่า</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 15%">รูปภาพ</th>
                            <th style="width: 20%">ชื่ออาหาร (ไทย)</th>
                            <th style="width: 15%">หมวดหมู่</th>
                            <th style="width: 35%">วัตถุดิบและส่วนผสม (Recipe)</th>
                            <th style="width: 15%" class="text-center">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php if (empty($foods)): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">ไม่พบข้อมูลอาหารในระบบ</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($foods as $food): ?>
                                <tr>
                                    <td>
                                        <?php if (!empty($food['image']) && file_exists('uploads/' . $food['image'])): ?>
                                            <img src="uploads/<?= htmlspecialchars($food['image']) ?>" alt="food" width="80"
                                                height="60" class="img-thumbnail" style="object-fit: cover;">
                                        <?php else: ?>
                                            <div class="bg-secondary text-white text-center rounded d-flex align-items-center justify-content-center"
                                                style="width: 80px; height: 60px; font-size: 11px;">
                                                ไม่มีรูปภาพ
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td><strong><?= htmlspecialchars($food['name_th']) ?></strong></td>
                                    <td><span class="badge bg-info text-dark"><?= htmlspecialchars($food['category']) ?></span>
                                    </td>
                                    <td>
                                        <?php if (!empty($food['recipes'])): ?>
                                            <ul class="mb-0 ps-3">
                                                <?php foreach ($food['recipes'] as $r): ?>
                                                    <li><?= htmlspecialchars($r['recipe_name']) ?>
                                                        <?= htmlspecialchars($r['quantity']) ?>                 <?= htmlspecialchars($r['unit_name']) ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php else: ?>
                                            <span class="text-muted small">ไม่มีข้อมูลวัตถุดิบ</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="manage.php?id=<?= $food['id'] ?>"
                                            class="btn btn-sm btn-warning mb-1 mb-md-0">แก้ไข</a>
                                        <a href="index.php?delete_id=<?= $food['id'] ?>" class="btn btn-sm btn-danger"
                                            onclick="return confirm('คุณแน่ใจหรือไม่ที่จะลบเมนูนี้?');">ลบ</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>