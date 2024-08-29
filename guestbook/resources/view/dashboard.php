<main>
<h1>Hi, <?=$user->fname?> </h1>

<section id="container">

    <nav>
        <ul>
            <li class="active"><button>Books</button><span class="count"><?=count($books)?></span></li>
            <li>
                <form method="POST" action="/guestbook/create">
                    <button class="call-to-action">Create</button>
                    <input type="text"  name="name" placeholder="Enter book title" required>
                </form>
                
            </li>
        </ul>
    </nav>

    <div id="book-list-container">

    <?php foreach($books as $book):?>
        <div class="row">
            <div class="book-name"><h3><?=$book["name"]?></h3></div>
            <div class="functions">
                    <form method="POST" action="/guestbook/delete"> 
                        <input type='hidden' name="id" value=<?=$book['id']?>>
                        <button title="delete this book">Delete</button>
                    </form>
                    <form method="POST" action="/guestbook/view"> 
                        <input type='hidden' name="bookId" value=<?=$book['id']?>>
                        <button title="view messages in this book">View</button>
                    </form>
                    <form method="POST" action="/guestbook/publish"> 
                        <input type='hidden' name="bookId" value=<?=$book['id']?>>
                        <input type='hidden' name="name" value=<?=$book['name']?>>
                        <button title="Open guest book">Publish</button>
                    </form>

            </div>
        </div>
    <?php endforeach;?>
    </div>
</section>
<form method="POST" class="log-out-form" action="/guestbook/logout">
    <button id="log-out-btn">Logout</button>
</form>
</main>
