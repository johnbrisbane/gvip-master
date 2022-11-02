<style>
:root {
    --blue-background: #005268;
    --purple-blue-text: #0E1B4D;
}

.biden-departments__container {
    width: 100%;
    height: 90%;
}

.departments-title {
    margin: 0.5em 0.75em;
    font-size: 3em;
    font-weight: bolder;

    color: var(--purple-blue-text);
}

.departments-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(200px, 25%));
    grid-template-rows: repeat(2, 50%);
    width: 100%;
    height: 92%;

}

.department-card__container {

    display: flex;
    align-items: center;
    justify-content: center;
}

.department-card {
    border-radius: 10px;
    box-shadow:
        0 2.8px 2.2px rgba(0, 0, 0, 0.034),
        0 6.7px 5.3px rgba(0, 0, 0, 0.048),
        0 12.5px 10px rgba(0, 0, 0, 0.06),
        0 22.3px 17.9px rgba(0, 0, 0, 0.072),
        0 41.8px 33.4px rgba(0, 0, 0, 0.086),
        0 100px 80px rgba(0, 0, 0, 0.12);
    width: 90%;
    height: 90%;
    background: white;
    text-decoration: none !important;
}

.department-card:hover {
    transform: scale(1.05);
    transition: 300ms;
}

.department-logo__container {
    width: 100%;
    height: 85%;
}

.department-logo {
    width: 100%;
    height: 100%;
    object-fit: scale-down;
}

.department-name {
    font-size: 1.85rem;
    font-weight: 600;
    text-align: center;
    color: var(--purple-blue-text);
    text-decoration: none !important;
}

@media screen and (max-width:1450px) {
    .department-logo__container {
        height: 80%;
    }
}

@media screen and (max-width:900px) {
    .departments-title {
        font-size: 2.5em;
        text-align: center;
    }

    footer {
        display: none;
    }

    .departments-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(200px, 50%));
        grid-template-rows: repeat(4, 50%);
        width: 100%;
        height: 92%;

    }
}

@media screen and (max-width:460px) {
    .departments-title {
        text-align: 2em;
    }

    .departments-grid {
        display: grid;
        grid-template-columns: repeat(1, minmax(200px, 100%));
        grid-template-rows: repeat(8, 50%);
        width: 100%;
        height: 92%;

    }

    .department-logo__container {
        width: 100%;
        height: 80%;
    }
}
</style>

<div class="biden-departments__container">
    <h1 class="departments-title">Departments</h1>
    <div class="departments-grid">

        <?php
            $index = 0;
            if (count($users) > 0) {
                foreach($users as $key=> $val) {

                    $fullname =  $val['Department'];

                    if ($val['name'] == ''){
                        if ($val['Department'] == 'Department of Transportation (DOT)') {
                            $val['photo'] = 'https://d2huw5an5od7zn.cloudfront.net/Biden+Admin+photos/drive-download-20210127T173459Z-001/DOT+LOGO.jpg';
                            $abname = 'DOT';
                        }
                        elseif ($val['Department'] == 'Department of the Interior (DOI)'){
                            $val['photo'] = 'https://d2huw5an5od7zn.cloudfront.net/Biden+Admin+photos/drive-download-20210127T173459Z-001/INTERIOR+LOGO.png';
                            $abname = 'DOI';
                        }
                        elseif ($val['Department'] == 'Department of Commerce (DOC)'){
                            $val['photo'] = 'https://d2huw5an5od7zn.cloudfront.net/Biden+Admin+photos/drive-download-20210127T173459Z-001/COMMERCE+LOGO.png';
                            $abname = 'DOC';
                        }
                        elseif ($val['Department'] == 'Department of Energy (DOE)'){
                            $val['photo'] = 'https://d2huw5an5od7zn.cloudfront.net/Biden+Admin+photos/drive-download-20210127T173459Z-001/DOE+LOGO.png';
                            $abname = 'DOE';
                        }
                        elseif ($val['Department'] == 'Department of Agriculture (USDA)'){
                            $val['photo'] = 'https://d2huw5an5od7zn.cloudfront.net/Biden+Admin+photos/drive-download-20210127T173459Z-001/USDA+LOGO.png';
                            $abname = 'USDA';
                        }
                        elseif ($val['Department'] == 'Department of Labor (DOL)'){
                            $val['photo'] = 'https://d2huw5an5od7zn.cloudfront.net/Biden+Admin+photos/drive-download-20210127T173459Z-001/LABOR+LOGO.png';
                            $abname = 'DOL';
                        }
                        elseif ($val['Department'] == 'White House Executive Office of the President'){
                            $val['photo'] = 'https://d2huw5an5od7zn.cloudfront.net/Biden+Admin+photos/drive-download-20210127T173459Z-001/EXEC+OFFICE+OF+PRESIDENT+LOGO.png';
                            $abname = 'WHEO';
                        }
                        elseif ($val['Department'] == 'Small Business Administration (SBA)'){
                            $val['photo'] = 'https://d2huw5an5od7zn.cloudfront.net/Biden+Admin+photos/drive-download-20210127T173459Z-001/SBA-PoweredBy-FINAL_1.png';
                            $abname = 'SBA';
                        }
                    }

                    $data = array(
                        'url' => base_url() . 'expertise/biden_admin/' . $abname,
                        'image' => array(
                            'url' => $val['photo'],
                            'alt' =>  $val['Department'] . ' image'
                        ),
                        'title' => '<strong>' . $fullname . '</strong><br>' .$val['position'],
                        'last' => ($index == 3),
                        'bio' => $val['bio'],
                        'department' => $val['Department']
                    );
                    if ($val['name'] == '') {
                        ?>



        <a href="<?php echo $data['url']; ?>" class="department-card__container">
            <div class="department-card">
                <div class="department-logo__container">
                    <img class="department-logo" src="<?php echo $val['photo']?>">
                </div>
                <h1 class="department-name">
                    <?php echo  $fullname  . $val['position']; ?>
                </h1>
            </div>
        </a>
        <?php
                    }
                    $index = ($index == 3) ? 0 : $index + 1;
                }
            } else {
                echo form_list_empty(lang('NoExpertisedplay'));
            }
            ?>
    </div>
</div>

<div id="dialog-message"></div>