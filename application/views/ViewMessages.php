<!DOCTYPE html> 
<html> 
<head><title>View Messages</title></head> 
<body>
<table>
 <?php foreach ($results as $row) {?>
  <tr>
    <td><?php echo $row['user_username']; ?></td>
    <td><?php echo $row['text']; ?></td>
	<td><?php echo $row['posted_at']; ?></td>
  </tr>
<?php } ?>
</table> 
</body> 
</html>