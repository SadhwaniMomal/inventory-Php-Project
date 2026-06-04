<?php

namespace Database\Seeders;

use App\Models\ChartOfAccount;
use Illuminate\Database\Seeder;

class ChartOfAccountsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    ChartOfAccount::whereRaw('LENGTH(account_code) - LENGTH(REPLACE(account_code, "-", "")) >= 3')->delete();

    $accounts = array_values(array_filter([
      ['code' => '01', 'name' => 'ASSETS'],
      ['code' => '01-01', 'name' => 'CASH IN HANDS / BANK ACCOUTS'],
      ['code' => '01-01-01', 'name' => 'CASH ACCOUNTS'],
      ['code' => '01-01-01-01', 'name' => 'Cash in Hand'],
      ['code' => '01-01-01-02', 'name' => 'Cash in hand home'],
      ['code' => '01-01-02', 'name' => 'BANK ACCOUNTS'],
      ['code' => '01-01-02-01', 'name' => 'MEEZAN BANK M.NOMAN 273'],
      ['code' => '01-01-02-02', 'name' => 'MEEZAN BANK M.NOMAN 581'],
      ['code' => '01-01-02-03', 'name' => 'MEEZAN BANK M.SHAHZAD 4532'],
      ['code' => '01-02', 'name' => 'INVENTORY ACCOUNTS'],
      ['code' => '01-02-01', 'name' => 'RAW INVENTORY'],
      ['code' => '01-02-01-01', 'name' => 'RAW MATERIAL INVENTORY'],
      ['code' => '01-02-02', 'name' => 'WORK IN PROGRESS'],
      ['code' => '01-02-02-01', 'name' => 'WIP DESIGN'],
      ['code' => '01-02-02-02', 'name' => 'WIP PRODUCTION'],
      ['code' => '01-02-03', 'name' => 'FINISH GOODS INVENTORY'],
      ['code' => '01-02-03-01', 'name' => 'FINISH ITEM INVENTORY'],
      ['code' => '01-03', 'name' => 'RECEIVABLES ACCOUNTS'],
      ['code' => '01-03-01', 'name' => 'LOCAL CUSTOMERS ACCOUNTS'],
      ['code' => '01-03-01-01', 'name' => 'ABC HANDICRAFTS HYDERABAD'],
      ['code' => '01-03-01-02', 'name' => 'BCD HANDICRAFTS KARACHI'],
      ['code' => '01-03-01-03', 'name' => 'CDE HANDICRAFTS MURREE'],
      ['code' => '01-03-02', 'name' => 'EXPORT CUSTOMERS ACCOUNTS'],
      ['code' => '01-03-02-01', 'name' => 'ABC SAUDI ARABIA'],
      ['code' => '01-03-02-02', 'name' => 'BCD DUBAI'],
      ['code' => '01-03-03', 'name' => 'OTHER RECEIVABLE ACCOUNTS'],
      ['code' => '01-03-03-01', 'name' => 'ABC RECEIVABLES'],
      ['code' => '01-03-03-02', 'name' => 'BCD RECEIVABLES'],
      ['code' => '02', 'name' => 'LIABILITY'],
      ['code' => '02-01', 'name' => 'VENDOR ACCOUNTS'],
      ['code' => '02-01-01', 'name' => 'EMBROIDERY VENDORS'],
      ['code' => '02-01-01-01', 'name' => 'ABC EMBROIDERY'],
      ['code' => '02-01-01-02', 'name' => '123 EMBROIDERY'],
      ['code' => '02-01-02', 'name' => 'SILAI VENDORS OUTSIDE'],
      ['code' => '02-01-02-01', 'name' => 'DEF SILAI'],
      ['code' => '02-01-03', 'name' => 'SILAI VENDORS KARKHANA'],
      ['code' => '02-01-03-01', 'name' => 'GHI SILAI'],
      ['code' => '02-01-04', 'name' => 'TAKAI VENDORS'],
      ['code' => '02-01-04-01', 'name' => 'JKL TAKAI'],
      ['code' => '02-01-05', 'name' => 'SUPPLIER ACCOUNTS'],
      ['code' => '02-01-05-01', 'name' => 'BCD SUPPLIER'],
      ['code' => '02-01-06', 'name' => 'OTHER PAYABLES'],
      ['code' => '02-01-06-01', 'name' => 'ABC PAYABLE'],
      ['code' => '02-01-06-02', 'name' => 'BCD PAYABLE'],
      ['code' => '03', 'name' => 'EQUITY'],
      ['code' => '03-01', 'name' => 'OWNERS EQUITY ACCOUNTS'],
      ['code' => '03-01-01', 'name' => 'CAPITAL ACCOUNTS'],
      ['code' => '03-01-01-01', 'name' => 'ABDUL WAHID CAPITAL'],
      ['code' => '03-01-02', 'name' => 'OWNERS DRAWINGS ACCOUNTS'],
      ['code' => '03-01-02-01', 'name' => 'ABDUL WAHID DRAWINGS'],
      ['code' => '04', 'name' => 'SALES / REVENUE'],
      ['code' => '04-01', 'name' => 'SALES AND REVENUE ACCOUNTS'],
      ['code' => '04-01-01', 'name' => 'SALES ACCOUNTS'],
      ['code' => '04-01-01-01', 'name' => 'LOCAL SALES ACCOUNT'],
      ['code' => '04-01-01-02', 'name' => 'VP SALES ACCOUNT'],
      ['code' => '04-01-01-03', 'name' => 'EXPORT SALES ACCOUNT'],
      ['code' => '05', 'name' => 'BUSINESS EXPENDITURES'],
      ['code' => '05-01', 'name' => 'MANUFACTURING EXPENCES'],
      ['code' => '05-01-01', 'name' => 'KARKHANA EXPENDITURES'],
      ['code' => '05-01-01-01', 'name' => 'KARKHANA WEEKLY EXPENCES'],
      ['code' => '05-01-01-02', 'name' => 'KARKHANA MONTHLY RENT'],
      ['code' => '05-01-01-03', 'name' => 'KARKHANA ELECTRIC BILLS'],
      ['code' => '05-01-01-04', 'name' => 'KARKHANA MACHINE EXPENCES'],
      ['code' => '05-02', 'name' => 'ADMINISTRATION EXPENCES'],
      ['code' => '05-02-01', 'name' => 'GOWDON EXPENDITURES'],
      ['code' => '05-02-01-01', 'name' => 'DAILY GOWDON EXPENCES'],
      ['code' => '05-02-01-02', 'name' => 'PACKING EXPENCES'],
      ['code' => '05-02-01-03', 'name' => 'GOWDON MONTHLY RENT'],
      ['code' => '05-02-01-04', 'name' => 'GOWDON SALARIES'],
      ['code' => '05-02-02', 'name' => 'SHOP EXPENDITURES'],
      ['code' => '05-02-02-01', 'name' => 'SHOP MONTHLY RENT'],
      ['code' => '05-02-02-02', 'name' => 'SHOP ELECTRIC BILLS'],
      ['code' => '05-02-02-03', 'name' => 'SHOP SALARIES'],
      ['code' => '05-02-02-04', 'name' => 'SHOP DAILY EXPENCES'],
      ['code' => '05-02-03', 'name' => 'TRANSPORTATION EXPENDITURES'],
      ['code' => '05-02-03-01', 'name' => 'TRANSPORT INN EXPENCES'],
      ['code' => '05-02-03-02', 'name' => 'TRANSPORT OUT EXPENCES'],
    ], fn($account) => substr_count($account['code'], '-') < 3));

    $prefixMap = [
      '01' => 'assets',
      '02' => 'liability',
      '03' => 'equity',
      '04' => 'revenue',
      '05' => 'expense',
    ];

    $natureMap = [
      'assets' => 'debit',
      'liability' => 'credit',
      'equity' => 'credit',
      'revenue' => 'credit',
      'expense' => 'debit',
    ];

    $createdCodes = [];

    foreach ($accounts as $account) {
      $parentCode = substr($account['code'], 0, strrpos($account['code'], '-'));
      $parentId = null;

      if ($parentCode !== false) {
        $parentId = $createdCodes[$parentCode]['id'] ?? ChartOfAccount::where('account_code', $parentCode)->value('id');
      }

      $accountType = $prefixMap[substr($account['code'], 0, 2)] ?? 'expense';

      $record = ChartOfAccount::updateOrCreate(
        ['account_code' => $account['code']],
        [
          'account_name' => $account['name'],
          'account_type' => $accountType,
          'parent_id' => $parentId,
          'nature_account' => $natureMap[$accountType] ?? 'debit',
          'current_balance' => 0,
        ]
      );

      $createdCodes[$account['code']] = ['id' => $record->id];
    }
  }
}
