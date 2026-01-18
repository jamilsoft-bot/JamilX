<?php
// Admin account setup step.
$defaults = [
    'name' => '',
    'username' => '',
    'password' => '',
    'email' => '',
    'phone' => '',
    'dob' => '',
    'gender' => 'Male',
    'address' => '',
    'state' => '',
    'country' => '',
    'city' => '',
    'role' => 'admin',
];
$values = array_merge($defaults, $formValues);
?>
<div>
    <h2 class="text-2xl font-semibold text-slate-900">Admin Account Setup</h2>
    <p class="mt-2 text-slate-600">Create the primary administrator profile for your new JamilX installation.</p>

    <form method="post" class="mt-6" data-validate-form>
        <input type="hidden" name="action" value="save_admin">
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="text-sm font-medium text-slate-700">Full Name</label>
                <input type="text" name="name" data-required class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2" value="<?php echo installer_escape($values['name']); ?>" placeholder="Full name">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-700">Username</label>
                <input type="text" name="username" data-required class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2" value="<?php echo installer_escape($values['username']); ?>" placeholder="Username">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-700">Password</label>
                <input type="password" name="password" data-required class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2" placeholder="Password">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-700">Email</label>
                <input type="email" name="email" data-required class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2" value="<?php echo installer_escape($values['email']); ?>" placeholder="admin@example.com">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-700">Phone Number</label>
                <input type="text" name="phone" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2" value="<?php echo installer_escape($values['phone']); ?>" placeholder="Phone number">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-700">Date of Birth</label>
                <input type="date" name="dob" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2" value="<?php echo installer_escape($values['dob']); ?>">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-700">Gender</label>
                <select name="gender" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2">
                    <option value="Male" <?php echo $values['gender'] === 'Male' ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?php echo $values['gender'] === 'Female' ? 'selected' : ''; ?>>Female</option>
                </select>
            </div>
            <div>
                <label class="text-sm font-medium text-slate-700">Home Address</label>
                <input type="text" name="address" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2" value="<?php echo installer_escape($values['address']); ?>" placeholder="Home address">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-700">State</label>
                <input type="text" name="state" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2" value="<?php echo installer_escape($values['state']); ?>" placeholder="State">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-700">Country</label>
                <select name="country" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2">
                    <option value="">Select country</option>
                    <option value="Afghanistan" <?php echo $values['country'] === 'Afghanistan' ? 'selected' : ''; ?>>Afghanistan</option>
                    <option value="Aland Islands" <?php echo $values['country'] === 'Aland Islands' ? 'selected' : ''; ?>>Åland Islands</option>
                    <option value="Albania" <?php echo $values['country'] === 'Albania' ? 'selected' : ''; ?>>Albania</option>
                    <option value="Algeria" <?php echo $values['country'] === 'Algeria' ? 'selected' : ''; ?>>Algeria</option>
                    <option value="American Samoa" <?php echo $values['country'] === 'American Samoa' ? 'selected' : ''; ?>>American Samoa</option>
                    <option value="Andorra" <?php echo $values['country'] === 'Andorra' ? 'selected' : ''; ?>>Andorra</option>
                    <option value="Angola" <?php echo $values['country'] === 'Angola' ? 'selected' : ''; ?>>Angola</option>
                    <option value="Anguilla" <?php echo $values['country'] === 'Anguilla' ? 'selected' : ''; ?>>Anguilla</option>
                    <option value="Antarctica" <?php echo $values['country'] === 'Antarctica' ? 'selected' : ''; ?>>Antarctica</option>
                    <option value="Antigua and Barbuda" <?php echo $values['country'] === 'Antigua and Barbuda' ? 'selected' : ''; ?>>Antigua & Barbuda</option>
                    <option value="Argentina" <?php echo $values['country'] === 'Argentina' ? 'selected' : ''; ?>>Argentina</option>
                    <option value="Armenia" <?php echo $values['country'] === 'Armenia' ? 'selected' : ''; ?>>Armenia</option>
                    <option value="Aruba" <?php echo $values['country'] === 'Aruba' ? 'selected' : ''; ?>>Aruba</option>
                    <option value="Australia" <?php echo $values['country'] === 'Australia' ? 'selected' : ''; ?>>Australia</option>
                    <option value="Austria" <?php echo $values['country'] === 'Austria' ? 'selected' : ''; ?>>Austria</option>
                    <option value="Azerbaijan" <?php echo $values['country'] === 'Azerbaijan' ? 'selected' : ''; ?>>Azerbaijan</option>
                    <option value="Bahamas" <?php echo $values['country'] === 'Bahamas' ? 'selected' : ''; ?>>Bahamas</option>
                    <option value="Bahrain" <?php echo $values['country'] === 'Bahrain' ? 'selected' : ''; ?>>Bahrain</option>
                    <option value="Bangladesh" <?php echo $values['country'] === 'Bangladesh' ? 'selected' : ''; ?>>Bangladesh</option>
                    <option value="Barbados" <?php echo $values['country'] === 'Barbados' ? 'selected' : ''; ?>>Barbados</option>
                    <option value="Belarus" <?php echo $values['country'] === 'Belarus' ? 'selected' : ''; ?>>Belarus</option>
                    <option value="Belgium" <?php echo $values['country'] === 'Belgium' ? 'selected' : ''; ?>>Belgium</option>
                    <option value="Belize" <?php echo $values['country'] === 'Belize' ? 'selected' : ''; ?>>Belize</option>
                    <option value="Benin" <?php echo $values['country'] === 'Benin' ? 'selected' : ''; ?>>Benin</option>
                    <option value="Bermuda" <?php echo $values['country'] === 'Bermuda' ? 'selected' : ''; ?>>Bermuda</option>
                    <option value="Bhutan" <?php echo $values['country'] === 'Bhutan' ? 'selected' : ''; ?>>Bhutan</option>
                    <option value="Bolivia" <?php echo $values['country'] === 'Bolivia' ? 'selected' : ''; ?>>Bolivia</option>
                    <option value="Bonaire, Sint Eustatius and Saba" <?php echo $values['country'] === 'Bonaire, Sint Eustatius and Saba' ? 'selected' : ''; ?>>Caribbean Netherlands</option>
                    <option value="Bosnia and Herzegovina" <?php echo $values['country'] === 'Bosnia and Herzegovina' ? 'selected' : ''; ?>>Bosnia & Herzegovina</option>
                    <option value="Botswana" <?php echo $values['country'] === 'Botswana' ? 'selected' : ''; ?>>Botswana</option>
                    <option value="Brazil" <?php echo $values['country'] === 'Brazil' ? 'selected' : ''; ?>>Brazil</option>
                    <option value="British Indian Ocean Territory" <?php echo $values['country'] === 'British Indian Ocean Territory' ? 'selected' : ''; ?>>British Indian Ocean Territory</option>
                    <option value="Brunei Darussalam" <?php echo $values['country'] === 'Brunei Darussalam' ? 'selected' : ''; ?>>Brunei</option>
                    <option value="Bulgaria" <?php echo $values['country'] === 'Bulgaria' ? 'selected' : ''; ?>>Bulgaria</option>
                    <option value="Burkina Faso" <?php echo $values['country'] === 'Burkina Faso' ? 'selected' : ''; ?>>Burkina Faso</option>
                    <option value="Burundi" <?php echo $values['country'] === 'Burundi' ? 'selected' : ''; ?>>Burundi</option>
                    <option value="Cambodia" <?php echo $values['country'] === 'Cambodia' ? 'selected' : ''; ?>>Cambodia</option>
                    <option value="Cameroon" <?php echo $values['country'] === 'Cameroon' ? 'selected' : ''; ?>>Cameroon</option>
                    <option value="Canada" <?php echo $values['country'] === 'Canada' ? 'selected' : ''; ?>>Canada</option>
                    <option value="Cape Verde" <?php echo $values['country'] === 'Cape Verde' ? 'selected' : ''; ?>>Cape Verde</option>
                    <option value="Cayman Islands" <?php echo $values['country'] === 'Cayman Islands' ? 'selected' : ''; ?>>Cayman Islands</option>
                    <option value="Central African Republic" <?php echo $values['country'] === 'Central African Republic' ? 'selected' : ''; ?>>Central African Republic</option>
                    <option value="Chad" <?php echo $values['country'] === 'Chad' ? 'selected' : ''; ?>>Chad</option>
                    <option value="Chile" <?php echo $values['country'] === 'Chile' ? 'selected' : ''; ?>>Chile</option>
                    <option value="China" <?php echo $values['country'] === 'China' ? 'selected' : ''; ?>>China</option>
                    <option value="Colombia" <?php echo $values['country'] === 'Colombia' ? 'selected' : ''; ?>>Colombia</option>
                    <option value="Comoros" <?php echo $values['country'] === 'Comoros' ? 'selected' : ''; ?>>Comoros</option>
                    <option value="Congo" <?php echo $values['country'] === 'Congo' ? 'selected' : ''; ?>>Congo - Brazzaville</option>
                    <option value="Congo, Democratic Republic of the Congo" <?php echo $values['country'] === 'Congo, Democratic Republic of the Congo' ? 'selected' : ''; ?>>Congo - Kinshasa</option>
                    <option value="Costa Rica" <?php echo $values['country'] === 'Costa Rica' ? 'selected' : ''; ?>>Costa Rica</option>
                    <option value="Cote D'Ivoire" <?php echo $values['country'] === "Cote D'Ivoire" ? 'selected' : ''; ?>>Côte d’Ivoire</option>
                    <option value="Croatia" <?php echo $values['country'] === 'Croatia' ? 'selected' : ''; ?>>Croatia</option>
                    <option value="Cuba" <?php echo $values['country'] === 'Cuba' ? 'selected' : ''; ?>>Cuba</option>
                    <option value="Curacao" <?php echo $values['country'] === 'Curacao' ? 'selected' : ''; ?>>Curaçao</option>
                    <option value="Cyprus" <?php echo $values['country'] === 'Cyprus' ? 'selected' : ''; ?>>Cyprus</option>
                    <option value="Czech Republic" <?php echo $values['country'] === 'Czech Republic' ? 'selected' : ''; ?>>Czechia</option>
                    <option value="Denmark" <?php echo $values['country'] === 'Denmark' ? 'selected' : ''; ?>>Denmark</option>
                    <option value="Djibouti" <?php echo $values['country'] === 'Djibouti' ? 'selected' : ''; ?>>Djibouti</option>
                    <option value="Dominica" <?php echo $values['country'] === 'Dominica' ? 'selected' : ''; ?>>Dominica</option>
                    <option value="Dominican Republic" <?php echo $values['country'] === 'Dominican Republic' ? 'selected' : ''; ?>>Dominican Republic</option>
                    <option value="Ecuador" <?php echo $values['country'] === 'Ecuador' ? 'selected' : ''; ?>>Ecuador</option>
                    <option value="Egypt" <?php echo $values['country'] === 'Egypt' ? 'selected' : ''; ?>>Egypt</option>
                    <option value="El Salvador" <?php echo $values['country'] === 'El Salvador' ? 'selected' : ''; ?>>El Salvador</option>
                    <option value="Equatorial Guinea" <?php echo $values['country'] === 'Equatorial Guinea' ? 'selected' : ''; ?>>Equatorial Guinea</option>
                    <option value="Eritrea" <?php echo $values['country'] === 'Eritrea' ? 'selected' : ''; ?>>Eritrea</option>
                    <option value="Estonia" <?php echo $values['country'] === 'Estonia' ? 'selected' : ''; ?>>Estonia</option>
                    <option value="Ethiopia" <?php echo $values['country'] === 'Ethiopia' ? 'selected' : ''; ?>>Ethiopia</option>
                    <option value="Fiji" <?php echo $values['country'] === 'Fiji' ? 'selected' : ''; ?>>Fiji</option>
                    <option value="Finland" <?php echo $values['country'] === 'Finland' ? 'selected' : ''; ?>>Finland</option>
                    <option value="France" <?php echo $values['country'] === 'France' ? 'selected' : ''; ?>>France</option>
                    <option value="Gabon" <?php echo $values['country'] === 'Gabon' ? 'selected' : ''; ?>>Gabon</option>
                    <option value="Gambia" <?php echo $values['country'] === 'Gambia' ? 'selected' : ''; ?>>Gambia</option>
                    <option value="Georgia" <?php echo $values['country'] === 'Georgia' ? 'selected' : ''; ?>>Georgia</option>
                    <option value="Germany" <?php echo $values['country'] === 'Germany' ? 'selected' : ''; ?>>Germany</option>
                    <option value="Ghana" <?php echo $values['country'] === 'Ghana' ? 'selected' : ''; ?>>Ghana</option>
                    <option value="Greece" <?php echo $values['country'] === 'Greece' ? 'selected' : ''; ?>>Greece</option>
                    <option value="Greenland" <?php echo $values['country'] === 'Greenland' ? 'selected' : ''; ?>>Greenland</option>
                    <option value="Guatemala" <?php echo $values['country'] === 'Guatemala' ? 'selected' : ''; ?>>Guatemala</option>
                    <option value="Guinea" <?php echo $values['country'] === 'Guinea' ? 'selected' : ''; ?>>Guinea</option>
                    <option value="Guyana" <?php echo $values['country'] === 'Guyana' ? 'selected' : ''; ?>>Guyana</option>
                    <option value="Haiti" <?php echo $values['country'] === 'Haiti' ? 'selected' : ''; ?>>Haiti</option>
                    <option value="Honduras" <?php echo $values['country'] === 'Honduras' ? 'selected' : ''; ?>>Honduras</option>
                    <option value="Hong Kong" <?php echo $values['country'] === 'Hong Kong' ? 'selected' : ''; ?>>Hong Kong</option>
                    <option value="Hungary" <?php echo $values['country'] === 'Hungary' ? 'selected' : ''; ?>>Hungary</option>
                    <option value="Iceland" <?php echo $values['country'] === 'Iceland' ? 'selected' : ''; ?>>Iceland</option>
                    <option value="India" <?php echo $values['country'] === 'India' ? 'selected' : ''; ?>>India</option>
                    <option value="Indonesia" <?php echo $values['country'] === 'Indonesia' ? 'selected' : ''; ?>>Indonesia</option>
                    <option value="Iran, Islamic Republic of" <?php echo $values['country'] === 'Iran, Islamic Republic of' ? 'selected' : ''; ?>>Iran</option>
                    <option value="Iraq" <?php echo $values['country'] === 'Iraq' ? 'selected' : ''; ?>>Iraq</option>
                    <option value="Ireland" <?php echo $values['country'] === 'Ireland' ? 'selected' : ''; ?>>Ireland</option>
                    <option value="Israel" <?php echo $values['country'] === 'Israel' ? 'selected' : ''; ?>>Israel</option>
                    <option value="Italy" <?php echo $values['country'] === 'Italy' ? 'selected' : ''; ?>>Italy</option>
                    <option value="Jamaica" <?php echo $values['country'] === 'Jamaica' ? 'selected' : ''; ?>>Jamaica</option>
                    <option value="Japan" <?php echo $values['country'] === 'Japan' ? 'selected' : ''; ?>>Japan</option>
                    <option value="Jordan" <?php echo $values['country'] === 'Jordan' ? 'selected' : ''; ?>>Jordan</option>
                    <option value="Kenya" <?php echo $values['country'] === 'Kenya' ? 'selected' : ''; ?>>Kenya</option>
                    <option value="Kuwait" <?php echo $values['country'] === 'Kuwait' ? 'selected' : ''; ?>>Kuwait</option>
                    <option value="Latvia" <?php echo $values['country'] === 'Latvia' ? 'selected' : ''; ?>>Latvia</option>
                    <option value="Lebanon" <?php echo $values['country'] === 'Lebanon' ? 'selected' : ''; ?>>Lebanon</option>
                    <option value="Liberia" <?php echo $values['country'] === 'Liberia' ? 'selected' : ''; ?>>Liberia</option>
                    <option value="Lithuania" <?php echo $values['country'] === 'Lithuania' ? 'selected' : ''; ?>>Lithuania</option>
                    <option value="Luxembourg" <?php echo $values['country'] === 'Luxembourg' ? 'selected' : ''; ?>>Luxembourg</option>
                    <option value="Madagascar" <?php echo $values['country'] === 'Madagascar' ? 'selected' : ''; ?>>Madagascar</option>
                    <option value="Malawi" <?php echo $values['country'] === 'Malawi' ? 'selected' : ''; ?>>Malawi</option>
                    <option value="Malaysia" <?php echo $values['country'] === 'Malaysia' ? 'selected' : ''; ?>>Malaysia</option>
                    <option value="Maldives" <?php echo $values['country'] === 'Maldives' ? 'selected' : ''; ?>>Maldives</option>
                    <option value="Mali" <?php echo $values['country'] === 'Mali' ? 'selected' : ''; ?>>Mali</option>
                    <option value="Malta" <?php echo $values['country'] === 'Malta' ? 'selected' : ''; ?>>Malta</option>
                    <option value="Mexico" <?php echo $values['country'] === 'Mexico' ? 'selected' : ''; ?>>Mexico</option>
                    <option value="Moldova, Republic of" <?php echo $values['country'] === 'Moldova, Republic of' ? 'selected' : ''; ?>>Moldova</option>
                    <option value="Morocco" <?php echo $values['country'] === 'Morocco' ? 'selected' : ''; ?>>Morocco</option>
                    <option value="Mozambique" <?php echo $values['country'] === 'Mozambique' ? 'selected' : ''; ?>>Mozambique</option>
                    <option value="Myanmar" <?php echo $values['country'] === 'Myanmar' ? 'selected' : ''; ?>>Myanmar</option>
                    <option value="Namibia" <?php echo $values['country'] === 'Namibia' ? 'selected' : ''; ?>>Namibia</option>
                    <option value="Nepal" <?php echo $values['country'] === 'Nepal' ? 'selected' : ''; ?>>Nepal</option>
                    <option value="Netherlands" <?php echo $values['country'] === 'Netherlands' ? 'selected' : ''; ?>>Netherlands</option>
                    <option value="New Zealand" <?php echo $values['country'] === 'New Zealand' ? 'selected' : ''; ?>>New Zealand</option>
                    <option value="Nicaragua" <?php echo $values['country'] === 'Nicaragua' ? 'selected' : ''; ?>>Nicaragua</option>
                    <option value="Niger" <?php echo $values['country'] === 'Niger' ? 'selected' : ''; ?>>Niger</option>
                    <option value="Nigeria" <?php echo $values['country'] === 'Nigeria' ? 'selected' : ''; ?>>Nigeria</option>
                    <option value="Norway" <?php echo $values['country'] === 'Norway' ? 'selected' : ''; ?>>Norway</option>
                    <option value="Oman" <?php echo $values['country'] === 'Oman' ? 'selected' : ''; ?>>Oman</option>
                    <option value="Pakistan" <?php echo $values['country'] === 'Pakistan' ? 'selected' : ''; ?>>Pakistan</option>
                    <option value="Panama" <?php echo $values['country'] === 'Panama' ? 'selected' : ''; ?>>Panama</option>
                    <option value="Peru" <?php echo $values['country'] === 'Peru' ? 'selected' : ''; ?>>Peru</option>
                    <option value="Philippines" <?php echo $values['country'] === 'Philippines' ? 'selected' : ''; ?>>Philippines</option>
                    <option value="Poland" <?php echo $values['country'] === 'Poland' ? 'selected' : ''; ?>>Poland</option>
                    <option value="Portugal" <?php echo $values['country'] === 'Portugal' ? 'selected' : ''; ?>>Portugal</option>
                    <option value="Qatar" <?php echo $values['country'] === 'Qatar' ? 'selected' : ''; ?>>Qatar</option>
                    <option value="Romania" <?php echo $values['country'] === 'Romania' ? 'selected' : ''; ?>>Romania</option>
                    <option value="Russian Federation" <?php echo $values['country'] === 'Russian Federation' ? 'selected' : ''; ?>>Russia</option>
                    <option value="Rwanda" <?php echo $values['country'] === 'Rwanda' ? 'selected' : ''; ?>>Rwanda</option>
                    <option value="Saudi Arabia" <?php echo $values['country'] === 'Saudi Arabia' ? 'selected' : ''; ?>>Saudi Arabia</option>
                    <option value="Senegal" <?php echo $values['country'] === 'Senegal' ? 'selected' : ''; ?>>Senegal</option>
                    <option value="Sierra Leone" <?php echo $values['country'] === 'Sierra Leone' ? 'selected' : ''; ?>>Sierra Leone</option>
                    <option value="Singapore" <?php echo $values['country'] === 'Singapore' ? 'selected' : ''; ?>>Singapore</option>
                    <option value="Slovakia" <?php echo $values['country'] === 'Slovakia' ? 'selected' : ''; ?>>Slovakia</option>
                    <option value="Slovenia" <?php echo $values['country'] === 'Slovenia' ? 'selected' : ''; ?>>Slovenia</option>
                    <option value="South Africa" <?php echo $values['country'] === 'South Africa' ? 'selected' : ''; ?>>South Africa</option>
                    <option value="Spain" <?php echo $values['country'] === 'Spain' ? 'selected' : ''; ?>>Spain</option>
                    <option value="Sri Lanka" <?php echo $values['country'] === 'Sri Lanka' ? 'selected' : ''; ?>>Sri Lanka</option>
                    <option value="Sudan" <?php echo $values['country'] === 'Sudan' ? 'selected' : ''; ?>>Sudan</option>
                    <option value="Sweden" <?php echo $values['country'] === 'Sweden' ? 'selected' : ''; ?>>Sweden</option>
                    <option value="Switzerland" <?php echo $values['country'] === 'Switzerland' ? 'selected' : ''; ?>>Switzerland</option>
                    <option value="Syrian Arab Republic" <?php echo $values['country'] === 'Syrian Arab Republic' ? 'selected' : ''; ?>>Syria</option>
                    <option value="Taiwan" <?php echo $values['country'] === 'Taiwan' ? 'selected' : ''; ?>>Taiwan</option>
                    <option value="Tanzania, United Republic of" <?php echo $values['country'] === 'Tanzania, United Republic of' ? 'selected' : ''; ?>>Tanzania</option>
                    <option value="Thailand" <?php echo $values['country'] === 'Thailand' ? 'selected' : ''; ?>>Thailand</option>
                    <option value="Togo" <?php echo $values['country'] === 'Togo' ? 'selected' : ''; ?>>Togo</option>
                    <option value="Trinidad and Tobago" <?php echo $values['country'] === 'Trinidad and Tobago' ? 'selected' : ''; ?>>Trinidad and Tobago</option>
                    <option value="Tunisia" <?php echo $values['country'] === 'Tunisia' ? 'selected' : ''; ?>>Tunisia</option>
                    <option value="Turkey" <?php echo $values['country'] === 'Turkey' ? 'selected' : ''; ?>>Turkey</option>
                    <option value="Uganda" <?php echo $values['country'] === 'Uganda' ? 'selected' : ''; ?>>Uganda</option>
                    <option value="Ukraine" <?php echo $values['country'] === 'Ukraine' ? 'selected' : ''; ?>>Ukraine</option>
                    <option value="United Arab Emirates" <?php echo $values['country'] === 'United Arab Emirates' ? 'selected' : ''; ?>>United Arab Emirates</option>
                    <option value="United Kingdom" <?php echo $values['country'] === 'United Kingdom' ? 'selected' : ''; ?>>United Kingdom</option>
                    <option value="United States" <?php echo $values['country'] === 'United States' ? 'selected' : ''; ?>>United States</option>
                    <option value="Uruguay" <?php echo $values['country'] === 'Uruguay' ? 'selected' : ''; ?>>Uruguay</option>
                    <option value="Vietnam" <?php echo $values['country'] === 'Vietnam' ? 'selected' : ''; ?>>Vietnam</option>
                    <option value="Yemen" <?php echo $values['country'] === 'Yemen' ? 'selected' : ''; ?>>Yemen</option>
                    <option value="Zambia" <?php echo $values['country'] === 'Zambia' ? 'selected' : ''; ?>>Zambia</option>
                    <option value="Zimbabwe" <?php echo $values['country'] === 'Zimbabwe' ? 'selected' : ''; ?>>Zimbabwe</option>
                </select>
            </div>
            <div>
                <label class="text-sm font-medium text-slate-700">City/Hometown</label>
                <input type="text" name="city" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2" value="<?php echo installer_escape($values['city']); ?>" placeholder="City">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-700">User Role</label>
                <select name="role" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2">
                    <option value="admin" <?php echo $values['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                </select>
            </div>
        </div>

        <div class="flex flex-wrap gap-3 pt-6">
            <a href="?step=company" class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-4 py-2 text-slate-600 hover:bg-slate-50">Back</a>
            <button type="submit" data-submit class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2 font-medium text-white shadow-sm hover:bg-blue-700">
                Complete Installation
            </button>
        </div>
    </form>
</div>
