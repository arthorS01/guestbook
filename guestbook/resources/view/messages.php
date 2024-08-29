<main>

<section id="container">

    <nav>
        <ul>
            <li class="active"><button>Messages</button><span class="count"><?=count($messages)?></span></li>
        </ul>
    </nav>

    <div id="book-list-container">

    <?php if(count($messages) ==0):?>
        <h2>Sorry, no messages here yet</h2>

    <?php else: ?>
    <?php foreach($messages as $message):?>
        <div class="row">
            <div class="sender-name"><h3><?=$message["sender"]?></h3></div>
            <div><?=$message["message"]?></div>
            <div class="functions">
                    <form method="POST" action="/guestbook/message/delete"> 
                        <input type='hidden' name="id" value=<?=$message['id']?>>
                        <button title="delete this book">Delete</button>
                    </form>
            </div>
        </div>
    <?php endforeach;?>
    </div>
    <?php endif;?>
</section>
<form method="POST" class="log-out-form" action="/guestbook/logout">
    <button>Logout</button>
</form>
</main>
