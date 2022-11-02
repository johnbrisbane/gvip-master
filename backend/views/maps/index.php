<div class="centercontent tables">

    <div class="pageheader notab">
        <h1 class="pagetitle">View Maps</h1>
        <span class="pagedesc">&nbsp;</span>
    </div><!--pageheader-->

    <div id="contentwrapper" class="contentwrapper">
        <div class="contenttitle2">
            <?php echo heading("View All Maps List", 3); ?>
        </div><!--contenttitle-->
        <div class="notibar" style="display:none">
            <a class="close"></a>
            <p></p>
        </div>
        <div class="tableoptions">
            <button class="deletebutton radius3" title="Delete Selected" name="dyntable_maps" id="#/admin.php/maps/destroy">Delete Selected</button> &nbsp;
            <?php
            echo 'Category:&nbsp;';
            echo form_custom_dropdown(
                "maps_category_filter",
                $categories,
                '',
                'id="maps_category_filter" class="radius3"',
                array(),
                array('class' => 'hardcoded', 'text'=>'- Select a category -', 'value' => '')
            );
            echo '&nbsp;&nbsp;Status:&nbsp;';
            echo form_custom_dropdown(
                "map_status_filter",
                array('draft' => 'Draft', 'active' => 'Active'),
                '',
                'id="map_status_filter" class="radius3"',
                array(),
                array('class' => 'hardcoded', 'text'=>'- Select a status -', 'value' => '')
            );
            ?>
        </div><!--tableoptions-->

        <table cellpadding="0" cellspacing="0" border="0" class="stdtable" id="dyntable_maps">
            <colgroup>
                <col class="con0" style="width: 4%" />
                <col class="con1" />
                <col class="con0" />
                <col class="con1" />
                <col class="con0" />
                <col class="con1" />
                <col class="con0" />
            </colgroup>
            <thead>
                <tr>
                    <th class="head0 nosort" align="center"><span class="center">
                        <?php echo form_checkbox(array(
                            'id' => 'select_all_header',
                            'name' => 'select_all_header',
                            'class' => 'checkall'
                        )); ?></span>
                    </th>
                    <th class="head1">ID</th>
                    <th class="head0">Title</th>
                    <th class="head1">Category</th>
                    <th class="head0">Status</th>
                    <th class="head0 nosort">Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="head0 nosort" align="center"><span class="center">
                        <?php echo form_checkbox(array(
                            'id' => 'select_all_header',
                            'name' => 'select_all_header',
                            'class' => 'checkall'
                        )); ?></span>
                    </th>
                    <th class="head1">ID</th>
                    <th class="head0">Title</th>
                    <th class="head1">Category</th>
                    <th class="head0">Status</th>
                    <th class="head0 nosort">Action</th>
                </tr>
            </tfoot>
            <tbody>
                <?php
                foreach($rows as $row) {
                ?>
                    <tr>
                        <td align="center"><span class="center"><?php echo form_checkbox(array(
                                    'id' => 'select_' . $row['id'],
                                    'name' =>' select_' . $row['id'],
                                    'value' => $row['id']
                                )); ?></span></td>

                        <td><?php echo $row['id']; ?></td>
                        <td>
                            <a href="/<?php echo index_page(); ?>/maps/edit/<?php echo $row['id']; ?>">
                                <?php echo $row['title']; ?>
                            </a>
                        </td>
                        <td><?php echo $row['category']; ?></td>
                        <td><?php echo ($row['status'] == '1') ? 'Active' : 'Draft'; ?></td>

                        <td>
                            <a class="delete" href="" name="<?php echo $row['id']; ?>" id="#/admin.php/maps/destroy">Delete</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div><!--contentwrapper-->
</div>