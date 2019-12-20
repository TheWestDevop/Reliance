<?php
function getStatistics() {
  $data = [];
  $data['users'] = [];
  // 65k rows
  $allTptp = TariffProviderTariffMatch::all();
  foreach ($allTptp->groupBy('user_id') as $each) {
    $one = [];
    $one['name'] = $each[0]->user->first_name . " " . $each[0]->user->last_name;
    foreach ($each as $single) {
      switch ($single->active_status) {
        case ActiveStatus::ACTIVE: // 1
          $one['valid'] += 1;
          $one['cash'] += floatval(GlobalVariable::getById(GlobalVariable::STANDARDIZATION_UNIT_PRICE)->value);
          break;
        case ActiveStatus::PENDING: // 2
          $one['pending']+=1;
          break;
        case ActiveStatus::DELETED: // 3
          $one['invalid'] += 1;
          break;
      }
      $one['total']+=1;
    }
    $one['cash'] = number_format($one['cash'],2);
    array_push($data['users'], $one);
  }
  return $data;
}