<table>
	<h3>Время работы: {$sensor_date_live}</h3>
	<thead>
		<tr>
			<th>ID</th>
			<th>Level</th>
			<th>Bat</th>
			<th>Rashod</th>
			<th>Date Time</th>
			<th>Reset status</th>
			<th>Last HTTP Code</th>
		</tr>
	</thead>
	<tbody>
		{foreach $listrec as $item}
			<tr>
				<td>{$item.id}</td>
				<td>{$item.level}</td>
				<td>{$item.bat}</td>
				<td>{$item.rashod}</td>
				<td>{$item.date_insert}</td>
				<td>{$item.reset}</td>
				<td>{$item.lastcode}</td>
			</tr>
		{/foreach}
	</tbody>
</table>