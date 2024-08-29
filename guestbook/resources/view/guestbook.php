
<body>
    
   <main>
    <div id="container">
    <h2>Hi there, would you like to tell us something?</h2>
        <form method="POST" action="/guestbook/message/post">  
            <div class="field">
                <label>Enter your name</label>
                <input type="text" name="sender" placeholder="John Arthur" required>
            </div>

            <div class="field">
                <label>Enter Message</label>
                <input type="text" name="message" required>
            </div>

            
            <div class="field">
               
                <input type="hidden" name="bookId" value=<?=$bookId?> required>
            </div>

            <input type="submit" id="submit-btn" value="Send" required>
            
        </form>
    
    </div>
        
   </main>
</body>