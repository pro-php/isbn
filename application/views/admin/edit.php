<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><?php echo $title; ?></div>
            <div class="card-body">
		<div role="alert" id="msgAlert"></div>
                <div class="row">
                    <div class="col-sm-4">
                        <form action="/admin/edit/<?php echo $data['id']; ?>" method="post" >
                            <div class="form-group">
                                <label>Имя пользователя</label>
                                <input class="form-control" type="text" value="<?=$data['name'];?>" name="name" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="text" value="<?=$data['email'];?>" name="email" required>
                            </div>
                            <div class="form-group">
                                <label>Текст задачи</label>
                                <textarea class="form-control" rows="3" name="description"><?=$data['description'];?></textarea>
                            </div>
			<div class="btn-group btn-group-toggle" data-toggle="buttons" <?php if (isset($data['disabled'])) echo 'disabled'; ?>>
			  <label>Задание выполненно: </label>
			  <label class="btn btn-warning <?php if  ($data['status']==1) echo 'active'; ?>">
			    <input type="radio" name="status" value="1" id="option1" autocomplete="off" <?php if  ($data['status']==1) echo 'checked="checked"'; ?>> ДА
			  </label>
			  <label class="btn btn-warning <?php if  ($data['status']==0) echo 'active'; ?>">
			    <input type="radio" name="status" value="0" id="option2" autocomplete="off" <?php if  ($data['status']==0) echo 'checked="checked"'; ?>> НЕТ
			  </label>
			</div>
			<br><br>
                            <button type="submit" class="btn btn-primary btn-block">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>