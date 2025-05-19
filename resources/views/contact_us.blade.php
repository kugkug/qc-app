@include('partials.unauth.header')
<div class="container">
    <h1>Connect with Us</h1>
    <p> We would love to respond o your queries and help you succeed. <br>
        Feel feel free to get in touch with us</p>
    <div class="contact-box">
        <div class="contact-left">
            <h3>Send your request</h3>
            <form>
                <div class="input-row">
                    <div class="input-group">
                            <label>First Name</label>
                            <input type="text" placeholder="First Name">
                    </div>

                    <div class="input-group">
                        <label>Last Name</label>
                        <input type="text" placeholder="Last Name">
                </div>

                </div>

                <div class="input-row">

                    <div class="input-group">
                        <label>Email</label>
                        <input type="text" placeholder="Email">
                    </div>

                    <div class="input-group">
                            <label>Phone</label>
                            <input type="text" maxlength="10" value="+63">
                    </div>
                    
                </div>

                <label>Message</label>
                <textarea rows="5" placeholder="Your Message"></textarea>

                <button type="submit">Send</button>

                    
            </form>
        </div>

        <div class="contact-right">
            <h3>Reach Us</h3>

            <table>
                <tr>
                    <td>SEND US AN EMAIL AT:</td>
                    <td>DBO@Quezoncity.gov.ph</td>
                </tr>

                <tr>
                    <td>PLEASE CALL US AT:</td>
                    <td>(+63)(02)8988-4242 loc 8907</td>
                </tr>
                <tr>
                    <td>OUR MAIN OFFICE:</td>
                    <td>Ground to 3rd floors, Civic Center D (BRO Bldg.), <br> Mayaman Street, Quezon City Hall Compound</td>
                </tr>
            </table>
        </div>
    </div>

</div>

@include('partials.unauth.footer')