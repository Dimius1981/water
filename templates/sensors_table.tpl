{foreach $sensors_list as $item}
<tr class="{$item.row_style}">
  <td align="center">{$item.factorynumber}</td>
  <td>{$item.name}</td>
  <td>{$item.last_level}</td>
  <td>{$item.last_rashod}</td>
  <td>7777777</td>
  <td>{$item.last_bat}</td>
  <td>{$item.last_date}</td>
  <td>{$item.sensor_date_live}</td>
  <td>
    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#setSensorsModal" data-sensor-num="{$item.factorynumber}" data-sensor-name="{$item.name}"><img src="templates/image/setting.png"></button>
    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delSensorsModal" data-sensor-num="{$item.factorynumber}" data-sensor-name="{$item.name}"><img src="templates/image/del.png"></button>
  </td>
</tr>
{/foreach}
