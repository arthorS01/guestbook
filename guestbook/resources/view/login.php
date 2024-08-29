
<body>
    
   <main>
   <h2>Welcome back, We've missed you</h2>
   <div id="container">
   
        <form method="POST" action="/guestbook/login">  
            <div class="field">
                <label>Enter your email</label>
                <input type="email" name="email" placeholder="examplemail@mai.com" required>
                <span class="error-msg"></span>
            </div>

            <div class="field">
                <label>Enter your Password</label>
                <input type="password"  min="8" name="password" required>
                <span class="error-msg"></span>
            </div>

            <input type="submit"  id="submit-btn" value="login" required>
            
        </form>
        <p>Dont have an account?,<a href="/guestbook/register">register</a></p>
    </div>
    
   </main>
</body>