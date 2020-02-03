<?php
//      外部ファイルを読み込む
require_once("../database.php");
require_once("../classes.php");
//データベース接続オブジェクトを取得
$pdo = connectDatabase();
//SQLを設定
$sql = "select * from areas";
// SQL実行オブジェクトを取得
$pstmt = $pdo->prepare($sql);
//SQLの実行

$pstmt->execute();

//結果セットを取得
$rs = $pstmt->fetchAll();

// データベース接続オブジェクトを破棄
disconnectDatabase($pdo);

// 結果セットを配列に格納
$areas = [];
foreach ($rs as $record) {
        $id = intval($record["id"]);
        $name = $record["name"];
        $area = new Area($id, $name);
        $areas[] = $area;
}

// 結果セットの確認

//echo "<pre>";
//var_dump($rs);
//var_dump($areas);
//echo "</pre>";
//exit(0);
?>


<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8" />
		<title>PDOを使ってみる</title>
	</head>
	<body>
		<h1>PDOを使ってみる</h1>
		<h2>地域を選択する</h2>
		<form action="restaurants.phpl" method="get">
		<select name="area">
			<option value="0">-- 選択してください --</option>
			<?php foreach ($areas as $area) {?>
			<option value="<?= $area->getId() ?>"></option><?= $area->getName() ?></option>
            <?php }  ?>
		</select>
		<input type="submit" value="選択" />
		</form>
	</body>
</html>