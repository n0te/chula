<?php

use Illuminate\Database\Seeder;
use App\ModuleStatus;
use App\UserType;
use App\Module;
use App\Faculty;
use App\Nationality;
use App\Department;
use App\Sex;
use App\Title;
use App\Occupation;
use App\RoleType;
use App\UserRole;
use App\User;
use App\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ModuleStatusesTableSeeder::class);
        $this->call(UserTypesTableSeeder::class);
        $this->call(ModulesTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(SexesTableSeeder::class);
        $this->call(TitlesTableSeeder::class);
        $this->call(NationalitiesTableSeeder::class);
        $this->call(OccupationsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UserRolesTableSeeder::class);
        $this->call(RoleTypesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UserModulesTableSeeder::class);
        $this->call(UserDocumentsTableSeeder::class);
        $this->call(LogsTableSeeder::class);
    }
}

class UserModulesTableSeeder extends Seeder {
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('user_modules')->truncate();
        DB::statement("SET foreign_key_checks=1");
    }
}

class RoleTypesTableSeeder extends Seeder {
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('role_types')->truncate();
        DB::statement("SET foreign_key_checks=1");

        RoleType::create(array('name' => 'admin'));
        RoleType::create(array('name' => 'member'));
    }
}

class ModulesTableSeeder extends Seeder {

    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('modules')->truncate();
        DB::statement("SET foreign_key_checks=1");

        Module::create(array('name' => 'Clinical Research Funds'));
        //Module::create(array('name' => 'MRC'));
        //Module::create(array('name' => 'Biostatistics'));
        //Module::create(array('name' => 'Animal House'));
    }
}

class RolesTableSeeder extends Seeder {
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('roles')->truncate();
        DB::statement("SET foreign_key_checks=1");

        //Role::create(array('name' => 'MRC admin','module'=>2,'role_type'=>1));
        Role::create(array('name' => 'Clinical Reseatch Funds admin','module'=>1,'role_type'=>1));
        //Role::create(array('name' => 'Biostatistics admin','module'=>3,'role_type'=>1));
        //Role::create(array('name' => 'Animal House admin','module'=>4,'role_type'=>1));
        //Role::create(array('name' => 'MRC member','module'=>2,'role_type'=>2));
        Role::create(array('name' => 'Clinical Reseatch Funds member','module'=>1,'role_type'=>2));
        //Role::create(array('name' => 'Biostatistics member','module'=>3,'role_type'=>2));
        //Role::create(array('name' => 'Animal House member','module'=>4,'role_type'=>2));
    }
}

class UserRolesTableSeeder extends Seeder {

    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('user_roles')->truncate();
        UserRole::create(array('user' => 1,'role' => 1) );//add admin as CRC admin
        //UserRole::create(array('user' => 1,'role'=> 2));
        //UserRole::create(array('user' => 1,'role'=> 3));
        //UserRole::create(array('user' => 1,'role'=> 4));
        DB::statement("SET foreign_key_checks=1");
    }
}

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('users')->truncate();
        DB::statement("SET foreign_key_checks=1");
    
        User::create(array('firstname' => 'superadmin','email' => env('DEFAULT_ADMIN'),'password' => bcrypt(env('DEFAULT_ADMIN_PASSWORD')),'title'=>1,'nationality'=>1,'type'=>1 ));
    }
}

class ModuleStatusesTableSeeder extends Seeder {

    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('module_statuses')->truncate();
        DB::statement("SET foreign_key_checks=1");

        ModuleStatus::create(array('name' => 'not requested'));
        ModuleStatus::create(array('name' => 'waiting for approval'));
        ModuleStatus::create(array('name' => 'approved'));
        ModuleStatus::create(array('name' => 'rejected'));
    }
    
}

class UserTypesTableSeeder extends Seeder {

    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('user_types')->truncate();
        DB::statement("SET foreign_key_checks=1");
        UserType::create(array('name' => 'บุคคลในคณะแพทย์'));
        UserType::create(array('name' => 'บุคคลากรในจุฬา'));
        UserType::create(array('name' => 'บุคคลากรในหน่วยงานรัฐ'));
        UserType::create(array('name' => 'บุคคลากรและอื่นๆในภาคเอกชน'));
    }

}

class DepartmentsTableSeeder extends Seeder {

    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('departments')->truncate();
        DB::statement("SET foreign_key_checks=1");

        Department::create(array('name' => 'กายวิภาคศาสตร์ (Anatomy)'));
        Department::create(array('name' => 'จิตเวชศาสตร์ (Psychiatry)'));
        Department::create(array('name' => 'จุลชีววิทยา (Microbiology)'));
        Department::create(array('name' => 'นิติเวชศาสตร์ (Forensic Medicine)'));
        Department::create(array('name' => 'ปรสิตวิทยา (Parasitology)'));
        Department::create(array('name' => 'พยาธิวิทยา (Pathology)'));
        Department::create(array('name' => 'เวชศาสตร์ป้องกันและสังคม (Preventive and Social Medicine)'));
        Department::create(array('name' => 'สรีรวิทยา (Physiology)'));
        Department::create(array('name' => 'กุมารเวชศาสตร์ (Pediatrics)'));
        Department::create(array('name' => 'จักษุวิทยา (Ophthalmology)'));
        Department::create(array('name' => 'ชีวเคมี (Biochemistry)'));
        Department::create(array('name' => 'เภสัชวิทยา (Pharmacology)'));
        Department::create(array('name' => 'รังสีวิทยา (Radiology)'));
        Department::create(array('name' => 'วิสัญญีวิทยา (Anesthesiology)'));
        Department::create(array('name' => 'เวชศาสตร์ชันสูตร(Laboratory Medicine)'));
        Department::create(array('name' => 'ศัลยศาสตร์ (Surgery)'));
        Department::create(array('name' => 'ออร์โธปิดิกส์ Orthopedics)'));
        Department::create(array('name' => 'เวชศาสตร์ฟื้นฟู (Rehabilitation Medicine)'));
        Department::create(array('name' => 'สูติศาสตร์-นรีเวชวิทยา (Obstetrics and Gynecology)'));
        Department::create(array('name' => 'โสต ศอ นาสิกวิทยา (Otolaryngology)'));
        Department::create(array('name' => 'อายุรศาสตร์ (Medicine)'));
        Department::create(array('name' => 'อื่นๆ'));
    }

}

class SexesTableSeeder extends Seeder {

    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('sexes')->truncate();
        DB::statement("SET foreign_key_checks=1");

        Sex::create(array('name' => 'หญิง'));
        Sex::create(array('name' => 'ชาย'));
    }

}

class OccupationsTableSeeder extends Seeder {

    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('occupations')->truncate();
        DB::statement("SET foreign_key_checks=1");

        Occupation::create(array('name' => 'นิสิต'));
        Occupation::create(array('name' => 'อาจารย์'));
        Occupation::create(array('name' => 'อื่นๆ'));
    }

}

class UserDocumentsTableSeeder extends Seeder {

    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('user_documents')->truncate();
        DB::statement("SET foreign_key_checks=1");
    }

}

class LogsTableSeeder extends Seeder {

    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('logs')->truncate();
        DB::statement("SET foreign_key_checks=1");
    }

}

class TitlesTableSeeder extends Seeder {

    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('titles')->truncate();
        DB::statement("SET foreign_key_checks=1");

        Title::create(array('name' => 'นาย'));
        Title::create(array('name' => 'นาง'));
        Title::create(array('name' => 'นางสาว'));
        Title::create(array('name' => 'ศ.ดร.นพ.'));
        Title::create(array('name' => 'รศ.ดร.'));
        Title::create(array('name' => 'อ.ดร.พญ.'));
        Title::create(array('name' => 'ศ.นพ.'));
        Title::create(array('name' => 'รศ.'));
        Title::create(array('name' => 'อ.พญ.'));
        Title::create(array('name' => 'ศ.ดร.พญ.'));
        Title::create(array('name' => 'ผศ.ดร.นพ.'));
        Title::create(array('name' => 'อ.ดร.'));
        Title::create(array('name' => 'ศ.พญ.'));
        Title::create(array('name' => 'ผศ.นพ.'));
        Title::create(array('name' => 'อ.'));
        Title::create(array('name' => 'ศ.ดร.'));
        Title::create(array('name' => 'ผศ.ดร.พญ.'));
        Title::create(array('name' => 'นพ.'));
        Title::create(array('name' => 'ศ.'));
        Title::create(array('name' => 'ผศ.พญ.'));
        Title::create(array('name' => 'พญ.'));
        Title::create(array('name' => 'รศ.ดร.นพ.'));
        Title::create(array('name' => 'ผศ.ดร.'));
        Title::create(array('name' => 'รศ.นพ.'));
        Title::create(array('name' => 'ผศ.'));
        Title::create(array('name' => 'รศ.ดร.พญ.'));
        Title::create(array('name' => 'อ.ดร.นพ.'));
        Title::create(array('name' => 'ดร.'));
        Title::create(array('name' => 'รศ.พญ.'));
        Title::create(array('name' => 'อ.นพ.'));
    }

}

class NationalitiesTableSeeder extends Seeder {

    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('nationalities')->truncate();
        DB::statement("SET foreign_key_checks=1");

        Nationality::create(array('name' => 'Thai'));
        Nationality::create(array('name' => 'Afghan'));
        Nationality::create(array('name' => 'Albanian'));
        Nationality::create(array('name' => 'Algerian'));
        Nationality::create(array('name' => 'American'));
        Nationality::create(array('name' => 'Andorran'));
        Nationality::create(array('name' => 'Angolan'));
        Nationality::create(array('name' => 'Antiguans'));
        Nationality::create(array('name' => 'Argentinean'));
        Nationality::create(array('name' => 'Armenian'));
        Nationality::create(array('name' => 'Australian'));
        Nationality::create(array('name' => 'Austrian'));
        Nationality::create(array('name' => 'Azerbaijani'));
        Nationality::create(array('name' => 'Bahamian'));
        Nationality::create(array('name' => 'Bahraini'));
        Nationality::create(array('name' => 'Bangladeshi'));
        Nationality::create(array('name' => 'Barbadian'));
        Nationality::create(array('name' => 'Barbudans'));
        Nationality::create(array('name' => 'Batswana'));
        Nationality::create(array('name' => 'Belarusian'));
        Nationality::create(array('name' => 'Belgian'));
        Nationality::create(array('name' => 'Belizean'));
        Nationality::create(array('name' => 'Beninese'));
        Nationality::create(array('name' => 'Bhutanese'));
        Nationality::create(array('name' => 'Bolivian'));
        Nationality::create(array('name' => 'Bosnian'));
        Nationality::create(array('name' => 'Brazilian'));
        Nationality::create(array('name' => 'British'));
        Nationality::create(array('name' => 'Bruneian'));
        Nationality::create(array('name' => 'Bulgarian'));
        Nationality::create(array('name' => 'Burkinabe'));
        Nationality::create(array('name' => 'Burmese'));
        Nationality::create(array('name' => 'Burundian'));
        Nationality::create(array('name' => 'Cambodian'));
        Nationality::create(array('name' => 'Cameroonian'));
        Nationality::create(array('name' => 'Canadian'));
        Nationality::create(array('name' => 'Cape Verdean'));
        Nationality::create(array('name' => 'Central African'));
        Nationality::create(array('name' => 'Chadian'));
        Nationality::create(array('name' => 'Chilean'));
        Nationality::create(array('name' => 'Chinese'));
        Nationality::create(array('name' => 'Colombian'));
        Nationality::create(array('name' => 'Comoran'));
        Nationality::create(array('name' => 'Congolese'));
        Nationality::create(array('name' => 'Costa Rican'));
        Nationality::create(array('name' => 'Croatian'));
        Nationality::create(array('name' => 'Cuban'));
        Nationality::create(array('name' => 'Cypriot'));
        Nationality::create(array('name' => 'Czech'));
        Nationality::create(array('name' => 'Danish'));
        Nationality::create(array('name' => 'Djibouti'));
        Nationality::create(array('name' => 'Dominican'));
        Nationality::create(array('name' => 'Dutch'));
        Nationality::create(array('name' => 'East Timorese'));
        Nationality::create(array('name' => 'Ecuadorean'));
        Nationality::create(array('name' => 'Egyptian'));
        Nationality::create(array('name' => 'Emirian'));
        Nationality::create(array('name' => 'Equatorial Guinean'));
        Nationality::create(array('name' => 'Eritrean'));
        Nationality::create(array('name' => 'Estonian'));
        Nationality::create(array('name' => 'Ethiopian'));
        Nationality::create(array('name' => 'Fijian'));
        Nationality::create(array('name' => 'Filipino'));
        Nationality::create(array('name' => 'Finnish'));
        Nationality::create(array('name' => 'French'));
        Nationality::create(array('name' => 'Gabonese'));
        Nationality::create(array('name' => 'Gambian'));
        Nationality::create(array('name' => 'Georgian'));
        Nationality::create(array('name' => 'German'));
        Nationality::create(array('name' => 'Ghanaian'));
        Nationality::create(array('name' => 'Greek'));
        Nationality::create(array('name' => 'Grenadian'));
        Nationality::create(array('name' => 'Guatemalan'));
        Nationality::create(array('name' => 'Guinea-Bissauan'));
        Nationality::create(array('name' => 'Guinean'));
        Nationality::create(array('name' => 'Guyanese'));
        Nationality::create(array('name' => 'Haitian'));
        Nationality::create(array('name' => 'Herzegovinian'));
        Nationality::create(array('name' => 'Honduran'));
        Nationality::create(array('name' => 'Hungarian'));
        Nationality::create(array('name' => 'I-Kiribati'));
        Nationality::create(array('name' => 'Icelander'));
        Nationality::create(array('name' => 'Indian'));
        Nationality::create(array('name' => 'Indonesian'));
        Nationality::create(array('name' => 'Iranian'));
        Nationality::create(array('name' => 'Iraqi'));
        Nationality::create(array('name' => 'Irish'));
        Nationality::create(array('name' => 'Israeli'));
        Nationality::create(array('name' => 'Italian'));
        Nationality::create(array('name' => 'Ivorian'));
        Nationality::create(array('name' => 'Jamaican'));
        Nationality::create(array('name' => 'Japanese'));
        Nationality::create(array('name' => 'Jordanian'));
        Nationality::create(array('name' => 'Kazakhstani'));
        Nationality::create(array('name' => 'Kenyan'));
        Nationality::create(array('name' => 'Kittian and Nevisian'));
        Nationality::create(array('name' => 'Kuwaiti'));
        Nationality::create(array('name' => 'Kyrgyz'));
        Nationality::create(array('name' => 'Laotian'));
        Nationality::create(array('name' => 'Latvian'));
        Nationality::create(array('name' => 'Lebanese'));
        Nationality::create(array('name' => 'Liberian'));
        Nationality::create(array('name' => 'Libyan'));
        Nationality::create(array('name' => 'Liechtensteiner'));
        Nationality::create(array('name' => 'Lithuanian'));
        Nationality::create(array('name' => 'Luxembourger'));
        Nationality::create(array('name' => 'Macedonian'));
        Nationality::create(array('name' => 'Malagasy'));
        Nationality::create(array('name' => 'Malawian'));
        Nationality::create(array('name' => 'Malaysian'));
        Nationality::create(array('name' => 'Maldivan'));
        Nationality::create(array('name' => 'Malian'));
        Nationality::create(array('name' => 'Maltese'));
        Nationality::create(array('name' => 'Marshallese'));
        Nationality::create(array('name' => 'Mauritanian'));
        Nationality::create(array('name' => 'Mauritian'));
        Nationality::create(array('name' => 'Mexican'));
        Nationality::create(array('name' => 'Micronesian'));
        Nationality::create(array('name' => 'Moldovan'));
        Nationality::create(array('name' => 'Monacan'));
        Nationality::create(array('name' => 'Mongolian'));
        Nationality::create(array('name' => 'Moroccan'));
        Nationality::create(array('name' => 'Mosotho'));
        Nationality::create(array('name' => 'Motswana'));
        Nationality::create(array('name' => 'Mozambican'));
        Nationality::create(array('name' => 'Namibian'));
        Nationality::create(array('name' => 'Nauruan'));
        Nationality::create(array('name' => 'Nepalese'));
        Nationality::create(array('name' => 'New Zealander'));
        Nationality::create(array('name' => 'Nicaraguan'));
        Nationality::create(array('name' => 'Nigerian'));
        Nationality::create(array('name' => 'Nigerien'));
        Nationality::create(array('name' => 'North Korean'));
        Nationality::create(array('name' => 'Northern Irish'));
        Nationality::create(array('name' => 'Norwegian'));
        Nationality::create(array('name' => 'Omani'));
        Nationality::create(array('name' => 'Pakistani'));
        Nationality::create(array('name' => 'Palauan'));
        Nationality::create(array('name' => 'Panamanian'));
        Nationality::create(array('name' => 'Papua New Guinean'));
        Nationality::create(array('name' => 'Paraguayan'));
        Nationality::create(array('name' => 'Peruvian'));
        Nationality::create(array('name' => 'Polish'));
        Nationality::create(array('name' => 'Portuguese'));
        Nationality::create(array('name' => 'Qatari'));
        Nationality::create(array('name' => 'Romanian'));
        Nationality::create(array('name' => 'Russian'));
        Nationality::create(array('name' => 'Rwandan'));
        Nationality::create(array('name' => 'Saint Lucian'));
        Nationality::create(array('name' => 'Salvadoran'));
        Nationality::create(array('name' => 'Samoan'));
        Nationality::create(array('name' => 'San Marinese'));
        Nationality::create(array('name' => 'Sao Tomean'));
        Nationality::create(array('name' => 'Saudi'));
        Nationality::create(array('name' => 'Scottish'));
        Nationality::create(array('name' => 'Senegalese'));
        Nationality::create(array('name' => 'Serbian'));
        Nationality::create(array('name' => 'Seychellois'));
        Nationality::create(array('name' => 'Sierra Leonean'));
        Nationality::create(array('name' => 'Singaporean'));
        Nationality::create(array('name' => 'Slovakian'));
        Nationality::create(array('name' => 'Slovenian'));
        Nationality::create(array('name' => 'Solomon Islander'));
        Nationality::create(array('name' => 'Somali'));
        Nationality::create(array('name' => 'South African'));
        Nationality::create(array('name' => 'South Korean'));
        Nationality::create(array('name' => 'Spanish'));
        Nationality::create(array('name' => 'Sri Lankan'));
        Nationality::create(array('name' => 'Sudanese'));
        Nationality::create(array('name' => 'Surinamer'));
        Nationality::create(array('name' => 'Swazi'));
        Nationality::create(array('name' => 'Swedish'));
        Nationality::create(array('name' => 'Swiss'));
        Nationality::create(array('name' => 'Syrian'));
        Nationality::create(array('name' => 'Taiwanese'));
        Nationality::create(array('name' => 'Tajik'));
        Nationality::create(array('name' => 'Tanzanian'));
        Nationality::create(array('name' => 'Togolese'));
        Nationality::create(array('name' => 'Tongan'));
        Nationality::create(array('name' => 'Trinidadian or Tobagonian'));
        Nationality::create(array('name' => 'Tunisian'));
        Nationality::create(array('name' => 'Turkish'));
        Nationality::create(array('name' => 'Tuvaluan'));
        Nationality::create(array('name' => 'Ugandan'));
        Nationality::create(array('name' => 'Ukrainian'));
        Nationality::create(array('name' => 'Uruguayan'));
        Nationality::create(array('name' => 'Uzbekistani'));
        Nationality::create(array('name' => 'Venezuelan'));
        Nationality::create(array('name' => 'Vietnamese'));
        Nationality::create(array('name' => 'Welsh'));
        Nationality::create(array('name' => 'Yemenite'));
        Nationality::create(array('name' => 'Zambian'));
        Nationality::create(array('name' => 'Zimbabwean'));
    }

}