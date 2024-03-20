<div class="log-box">
    <h1>Signup</h1>
    <form name="form-signup" method="POST" action="../model/signup.php">
        <div class="user-box">
            <input type="text" name="pseudo" required="" placeholder="Pseudo">
        </div>
        <div class="user-box">
            <input type="text" name="first_name" required="" placeholder="First Name">
        </div>
        <div class="user-box">
            <input type="text" name="last_name" required="" placeholder="Last Name">
        </div>
        <div class="user-box">
            <input type="text" name="email" required="" placeholder="Email">
        </div>
        <div class="user-box">
            <input type="date" name="birthday" id="birthday" placeholder="Birthday">
        </div>
        <div class="user-box">
            <input type="password" name="password" required="" placeholder="Password">
        </div>
        <div class="user-box">
            <input type="password" name="passwordRepeat" required="" placeholder="Repeat Password">
        </div>
        <input type="submit" id="join-btn" name="join" alt="Join" value="Join">
    </form>
</div>
