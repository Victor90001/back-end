<style>
body {background-color: white; color: black; font-family: "Bitstream Vera Sans", Tahoma, Verdana, Arial, sans-serif; font-size: 76%;}
h1 {text-align:center;}
h2, .hr {border-top: 1px dotted gray;}
table {border: 1px dotted gray;}
th {background-color: #ccc; font-size: 76%;}
td {height: 2em; padding: 1px 2px 1px 2px; font-size: 76%;}
input, select {font-size: 76%;}
.a td {background-color: #e0e0e0;}
.a, .b {height: 1.2em;}
.a td form, .b td form {margin:0;}
a, a:visited {color: #339; text-decoration: underline; font-weight: 700;}
form {margin-top: 15px;}
input {font-size: 100%;}
ul {margin-bottom: 1em;}
li {margin-bottom: 0.3em;}
</style>

<?php
//foreach ($c['#content'] as $content) {
  //print_r($content);
//}
?>
<body>
  <div class="form">
    <form action="" method="POST">
      <label> ФИО </label> <br>
      <input name="fio" <?php //if ($errors_ar['fio']) {print 'class="error"';} ?> value="<?php //print $values['fio']; ?>" /> <br>
      <label> Почта </label> <br>
      <input name="mail" type="email" <?php //if ($errors_ar['mail']) {print 'class="error"';} ?> value="<?php //print $values['mail']; ?>"/> <br>
      <label> Год рождения </label> <br>
      <select name="year" <?php //if ($errors_ar['year']) {print 'class="error"';} ?>>
        <option value="Выбрать">Выбрать</option>
        <?php
        for($i=1890;$i<=2022;$i++){
          //if($values['year']==$i){
            //printf("<option value=%d selected>%d год</option>",$i,$i);
          //}
          //else{
            printf("<option value=%d>%d год</option>",$i,$i);
          //}
        }
    ?>
    </select> <br>
    <!--<input name="year" type="date" /> <br>-->
    <label> Ваш пол </label> <br>
    <div <?php //if ($errors_ar['sex']) {print 'class="error"';} ?>>
      <input name="sex" type="radio" value="M" <?php //if($values['sex']=="M") {print 'checked';} ?>/> Мужчина
      <input name="sex" type="radio" value="W" <?php //if($values['sex']=="W") {print 'checked';} ?>/> Женщина
    </div>
    <label> Сколько у вас конечностей </label> <br>
    <div <?php //if ($errors_ar['limb']) {print 'class="error"';} ?>>
      <input name="limb" type="radio" value="1" <?php //if($values['limb']=="1") {print 'checked';} ?>/> 1 
      <input name="limb" type="radio" value="2" <?php //if($values['limb']=="2") {print 'checked';} ?>/> 2 
      <input name="limb" type="radio" value="3" <?php //if($values['limb']=="3") {print 'checked';} ?>/> 3 
      <input name="limb" type="radio" value="4" <?php //if($values['limb']=="4") {print 'checked';} ?>/> 4 
    </div>
    <label> Выберите суперспособности </label> <br>
    <select name="power[]" size="3" multiple <?php //if ($errors_ar['powers']) {print 'class="error"';} ?>>
      <option value="бессмертие" <?php //if($values['immortal']==1){print 'selected';} ?>>Бессмертие</option>
      <option value="прохождение сквозь стены" <?php //if($values['ghost']==1){print 'selected';} ?>>Прохождение сквозь стены</option>
      <option value="левитация" <?php //if($values['levitation']==1){print 'selected';} ?>>Левитация</option>
    </select> <br>
    <label> Краткая биография </label> <br>
    <textarea name="bio" rows="10" cols="15"><?php //print $values['bio']; ?></textarea> <br>
    <input name='dd' hidden value=<?php //print($_GET['edit_id']);?>>
    <input type="submit" name='edit' value="Edit"/>
    <input type="submit" name='del' value="Delete"/>
  </form>
    <p>
    
    <a href='admin.php' class="button">Назад</a>

    </p>
  </div>
</body>