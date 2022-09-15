<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Level</th>
			<th>Bat</th>
			<th>Rashod</th>
			<th>Date Time</th>
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
			</tr>
		{/foreach}
	</tbody>
</table>