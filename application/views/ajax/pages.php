
                            <table class="table">
                                <tr> 
                                    <th>ID</th>								
                                    <th width=100px>Заголовок</th>
									<th>description</th>
                                    <th>isbn</th>
                                    <th>isbn2</th>
                                    <th>isbn3</th>
                                    <th>isbn4</th>
                                    <th>isbn_wrong</th>
                                    <th>Лог</th>
                                </tr>
                                <?php foreach ($list as $val): ?>
                                    <tr>
                                        <td><?=$val['id'];?></td>
                                        <td><?=$val['title_ru'];?></td>
										 <td><?=$val['description_ru'];?></td>
					<td><?=$val['isbn'];?></td>
					<td><?=$val['isbn2'];?></td>
					<td><?=$val['isbn3'];?></td>
					<td><?=$val['isbn4'];?></td>
					<td><?=$val['isbn_wrong'];?></td>
					<td><font color=red><?=$val['log']?></font></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                            <?php echo $pagination; ?>
							
                    </div>
                </div>

			