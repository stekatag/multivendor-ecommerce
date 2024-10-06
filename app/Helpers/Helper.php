<?php

// Set sidebar item to active

function setActive(array $route) {
  if (is_array($route)) {
    foreach ($route as $r) {
      if (request()->routeIs($r)) return 'active';
    }
  }
}

function generateSwitch($name, $status, $id, $isFirst = false, $useBootstrap = false) {
  // Conditionally add 'mt-2' class only if it's not the first switch (for custom switch)
  $marginClass = $isFirst ? '' : 'mt-2';
  $checked = $status == 1 ? 'checked' : '';

  // Check if the name is 'status' and update the label text accordingly
  if ($name === 'status') {
    $labelText = $status == 1 ? 'Active' : 'Inactive';
  } else {
    $labelText = ucfirst(str_replace('_', ' ', $name)); // Default label text
  }

  // If $useBootstrap is true, use Bootstrap 5's form-switch styles
  if ($useBootstrap) {
    return '
      <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="switch_' . $id . '_' . $name . '" data-id="' . $id . '" data-type="' . $name . '" ' . $checked . '>
          <label class="form-check-label" for="switch_' . $id . '_' . $name . '">' . $labelText . '</label>
      </div>';
  }

  // Custom switch for admin with custom styles
  return '
  <label class="custom-switch ' . $marginClass . ' d-block">
      <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input change-switch" data-id="' . $id . '" data-type="' . $name . '" ' . $checked . '>
      <span class="custom-switch-indicator"></span>
      <span class="custom-switch-description">' . $labelText . '</span>
  </label>';
}
