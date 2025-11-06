<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor-Account aanmaken</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
        }
        
        .form-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            overflow: hidden;
            width: 100%;
        }
        
        .form-header {
            background: #4a00e0;
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .form-header h1 {
            font-size: 2.2rem;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .form-header p {
            opacity: 0.9;
            font-size: 1.1rem;
        }
        
        .login-form {
            padding: 40px;
        }
        
        .create-account {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .double {
            grid-column: span 2;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        
        .form-group.full-width {
            grid-column: span 2;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }
        
        .text-field {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s;
            background: #f9f9f9;
        }
        
        .text-field:focus {
            outline: none;
            border-color: #4a00e0;
            background: white;
            box-shadow: 0 0 0 3px rgba(74, 0, 224, 0.1);
        }
        
        .password-wrapper {
            position: relative;
        }
        
        .password-wrapper input {
            padding-right: 45px;
        }
        
        .password-toggler {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #777;
            cursor: pointer;
            font-size: 18px;
            transition: color 0.3s;
        }
        
        .password-toggler:hover {
            color: #4a00e0;
        }
        
        select.text-field {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1em;
        }
        
        .checkbox-group {
            display: flex;
            align-items: flex-start;
            grid-column: span 2;
            margin: 15px 0;
        }
        
        .checkbox-group input {
            margin-top: 5px;
            margin-right: 12px;
            accent-color: #4a00e0;
        }
        
        .checkbox-group label {
            margin-bottom: 0;
            font-weight: 400;
            line-height: 1.6;
        }
        
        .checkbox-group a {
            color: #4a00e0;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .checkbox-group a:hover {
            text-decoration: underline;
        }
        
        .btn-submit {
            grid-column: span 2;
            background: linear-gradient(to right, #8e2de2, #4a00e0);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 16px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(142, 45, 226, 0.3);
            margin-top: 10px;
        }
        
        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(142, 45, 226, 0.4);
        }
        
        .form-footer {
            text-align: center;
            margin-top: 25px;
            grid-column: span 2;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        
        .form-footer a {
            color: #4a00e0;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .form-footer a:hover {
            text-decoration: underline;
        }
        
        .auction-items {
            display: none;
            grid-column: span 2;
            background: #f0f5ff;
            padding: 20px;
            border-radius: 10px;
            margin-top: 10px;
            border-left: 4px solid #4a00e0;
        }
        
        .note {
            font-size: 0.9rem;
            color: #666;
            margin-top: 8px;
            font-style: italic;
        }
        
        .error-message {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }
        
        @media (max-width: 768px) {
            .double {
                grid-template-columns: 1fr;
            }
            
            .create-account {
                grid-template-columns: 1fr;
            }
            
            .double, .form-group.full-width, .checkbox-group, .btn-submit, .form-footer {
                grid-column: span 1;
            }
            
            .login-form {
                padding: 25px;
            }
        }
        
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo h2 {
            color: white;
            font-size: 2.5rem;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        
        .logo span {
            color: #ffd700;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <h2>Vendor<span>Connect</span></h2>
        </div>
        
        <div class="form-section">
            <div class="form-header">
                <h1>Vendor-Account aanmaken</h1>
                <p>Maak uw account aan om toegang te krijgen tot alle mogelijkheden</p>
            </div>
            
            <div class="login-form">
                <form class="create-account">
                    <div class="double">
                        <div class="form-group">
                            <label for="first_name">Voornaam</label>
                            <input type="text" class="text-field" name="first_name" required placeholder="Voornaam" id="first_name">
                        </div>
                        
                        <div class="form-group">
                            <label for="last_name">Achternaam</label>
                            <input type="text" class="text-field" name="last_name" required placeholder="Achternaam" id="last_name">
                        </div>
                    </div>
                    
                    <div class="double">
                        <div class="form-group">
                            <label for="email">E-mailadres</label>
                            <input type="email" class="text-field" name="email" required placeholder="E-mailadres" id="email">
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Wachtwoord</label>
                            <div class="password-wrapper">
                                <input type="password" class="text-field" name="password" required placeholder="Wachtwoord" id="password">
                                <button type="button" class="password-toggler" id="password-toggler">
                                    <i class="far fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="double">
                        <div class="form-group">
                            <label for="street">Straat + nummer</label>
                            <input type="text" class="text-field" name="street" required placeholder="Straat + nummer" id="street">
                        </div>
                        
                        <div class="form-group">
                            <label for="zip">Postcode</label>
                            <input type="text" class="text-field" name="zip" required placeholder="Postcode" id="zip">
                        </div>
                    </div>
                    
                    <div class="double">
                        <div class="form-group">
                            <label for="town">Plaats</label>
                            <input type="text" class="text-field" name="town" required placeholder="Plaats" id="town">
                        </div>
                        
                        <div class="form-group">
                            <label for="country">Land</label>
                            <input type="text" class="text-field" name="country" required placeholder="Land" id="country">
                        </div>
                    </div>
                    
                    <div class="double">
                        <div class="form-group">
                            <label for="vendor_name">Bedrijfsnaam</label>
                            <input type="text" class="text-field" name="vendor_name" required placeholder="Bedrijfsnaam" id="vendor_name">
                        </div>
                        
                        <div class="form-group">
                            <label for="vendor_about">Bedrijfsbeschrijving</label>
                            <input type="text" class="text-field" name="vendor_about" required placeholder="Bedrijfsbeschrijving" id="vendor_about">
                        </div>
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="event">Event</label>
                        <select name="event" class="text-field">
                            <option value="">Kies event..</option>
                            <option value="1">Tech Innovatie Summit 2023</option>
                            <option value="2">Design Forward Conference</option>
                            <option value="3">Digital Marketing Expo</option>
                        </select>
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="permissions">Welke opties wil je? (Houd Ctrl ingedrukt om meerdere te selecteren)</label>
                        <select name="permissions" id="permissions" multiple class="text-field">
                            <option value="logo">Logo advertentie</option>
                            <option value="movie">Video plaatsen</option>
                            <option value="stall">Stall plaatsen</option>
                            <option value="auction">Veiling-items plaatsen</option>
                            <option value="goodiebag">Goodiebag Item aanbieden</option>
                        </select>
                        <p class="note">Houd Ctrl (Windows) of Cmd (Mac) ingedrukt om meerdere opties te selecteren</p>
                    </div>
                    
                    <div class="auction-items" id="auction-items">
                        <div class="form-group">
                            <label for="auction_item_count">Aantal veilingitems</label>
                            <input type="number" class="text-field" name="auction_item_count" placeholder="Aantal items" id="auction_item_count">
                            <p class="note">Voer het aantal veilingitems in dat je wilt aanbieden</p>
                        </div>
                    </div>
                    
                    <div class="checkbox-group">
                        <input type="checkbox" id="terms" required>
                        <label for="terms">Ik ga akkoord met het <a href="#">Privacy beleid</a> &amp; de <a href="#">Algemene Voorwaarden</a></label>
                    </div>
                    
                    <button type="submit" class="btn-submit">Registreren</button>
                    
                    <div class="form-footer">
                        <p>Al een account? <a href="#">Log dan in.</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password toggler functionality
            const passwordToggler = document.getElementById('password-toggler');
            const passwordInput = document.getElementById('password');
            
            passwordToggler.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.innerHTML = type === 'password' ? '<i class="far fa-eye"></i>' : '<i class="far fa-eye-slash"></i>';
            });
            
            // Auction items toggle functionality
            const permissionsSelect = document.getElementById('permissions');
            const auctionItemsSection = document.getElementById('auction-items');
            
            permissionsSelect.addEventListener('change', function() {
                const selectedOptions = Array.from(this.selectedOptions).map(option => option.value);
                
                if (selectedOptions.includes('auction')) {
                    auctionItemsSection.style.display = 'block';
                } else {
                    auctionItemsSection.style.display = 'none';
                    document.getElementById('auction_item_count').value = '';
                }
            });
            
            // Form submission handling
            const form = document.querySelector('.create-account');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Check if auction is selected and item count is provided
                const auctionSelected = Array.from(permissionsSelect.selectedOptions).some(option => option.value === 'auction');
                const auctionCount = document.getElementById('auction_item_count').value;
                
                if (auctionSelected && !auctionCount) {
                    alert('Voer het aantal veilingitems in aangezien je "Veiling-items plaatsen" hebt geselecteerd');
                    return;
                }
                
                // Form is valid
                alert('Account succesvol aangemaakt!');
                form.reset();
                auctionItemsSection.style.display = 'none';
            });
        });
    </script>
</body>
</html>