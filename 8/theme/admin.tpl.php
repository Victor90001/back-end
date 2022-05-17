<style>
  table{
    margin: 0 auto;
  }
  table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
<table>
<tr>
  <th>Имя</th>
  <th>Почта</th>
  <th>Год рождения</th>
  <th>Пол</th>
  <th>Кол-во конечностей</th>
  <th>Суперсилы</th>
  <th>Биография</th>
</tr>
<?php
foreach ($c['admin'] as $id => $row) {
?>
  
  <tr>
    <td><?php print($row['name']); ?></td>
    <td><?php print($row['mail']); ?></td>
    <td><?php print($row['date']); ?></td>
    <td><?php print($row['sex']); ?></td>
    <td><?php print($row['limb']); ?></td>
    <td><?php foreach($row['powers'] as $pwr){print($pwr.' <br>');}; ?></td>
    <td><?php print($row['bio']); ?></td>
    <td>
      <form action="admin/<?php print($row['id']); ?>" method="POST">
        <input type="submit" name="del" value="Удалить">
      </form>
    </td>
  </tr>
<?php  
}
?>
</table>
