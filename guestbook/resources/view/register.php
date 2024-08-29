
<body>
    <main>
    <h2>New around here?, Register</h2>
    <div id="container">
    <form method="POST" action="/guestbook/register">
            
            <div class="field">
                <label>Enter your Firstname</label>
                <input type="text" name="fname" placeholder="John" required>
            </div>
    
            <div class="field">
                <label>Enter your lastname</label>
                <input type="text" name="lname" placeholder="Doe" required>
            </div>
    
    
            <div class="field">
                <label>Enter your email</label>
                <input type="email" name="email" placeholder="examplemail@mai.com" required>
            </div>
    
            <div class="field">
                <label>Enter your Password</label>
                <input type="password" min="8" name="password" required>
            </div>
    
            <input type="submit" id='submit-btn' value="Register">
            
        </form>
    
        <p>Already have an account?, <a href='/guestbook/login'>Login</p>
    </div>
        
    </main>
</body>