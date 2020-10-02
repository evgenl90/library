<?php require_once(__DIR__.'/db.php'); ?>
<style>
    h1, h2, h6, p{
        text-align:center;
    }
</style>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div class="container">
    <?php
    foreach (issuing_books() as $item){
        ?>
        <div  id="<?php echo $item['id']; ?>" style="display:none;">
                <h1>
                    Название книги
                    <?php
                    echo htmlspecialchars($item['title_book']);
                    ?>
                </h1>
                <h2>
                    Читатель
                    <?php
                    echo htmlspecialchars($item['reader']);
                    ?>
                </h2>
                <p>
                    Дата сдачи
                <?php
                echo htmlspecialchars($item['date']);
                ?>
                </p>
                <h6>
                        Cтатус
                <?php
                if((int)$item['status'] === 0) { ?>
                    Книга сдана
                <?php  }  else{ ?>

                            Сдать книгу

                <?php } ?>
                </h6>
        </div>
        <?php
    }
    ?>
</div>
<script>
    window.onload = function(){
        var id = window.location.search;
            var el = id.replace(/\?\=/,'');
        document.getElementById(el).style.display = "block";
        window.print();

    };
</script>
