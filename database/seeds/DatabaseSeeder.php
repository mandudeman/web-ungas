<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(UsersTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(RoleManageTableSeeder::class);

        $this->call(BranchTableSeeder::class);
        $this->call(IncomeExpenseTableSeeder::class);
        $this->call(IncomeExpenseGroupsTableSeeder::class);
        $this->call(IncomeExpenseHeadTableSeeder::class);
        $this->call(BankCashTableSeeder::class);

        // $this->call(InitialIncomeExpenseHeadBalanceTableSeeder::class);
        // $this->call(InitialBankCashTableSeeder::class);

        $this->call(DrVoucherTableSeeder::class);
        $this->call(CrVoucherTableSeeder::class);
        $this->call(JournalVoucherTableSeeder::class);
        $this->call(ContraVoucherTableSeeder::class);
    }
}
