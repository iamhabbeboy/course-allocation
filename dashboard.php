<?php session_start();
ob_start();
/**
 * Created by PhpStorm.
 * User: abb
 * Date: 11/14/14
 * Time: 4:45 PM
 */
$page = 'pages';
require '_eclassroom_Controller/config.php';

$page = 'pages';
//$nav = 'student';

if (isset($_GET['page']) && $_GET['page'] == 'student') {
	$nav = 'student';
} elseif (isset($_GET['page']) && $_GET['page'] == 'lecturer') {
	$nav = 'lecturer';
} else {
	$nav = 'student';
}

require 'header.php';
?>

<style>
    .smaller {
        font-size: 11px;
        background-color: #EEE !important;padding:20px;text-align: center;
    }
    .add-style {
        font-size: 3.2em;
        color:#EEE;
    }
    .course__small {
        font-size:11px;
        margin-top: 5px;
        font-weight: normal;
        text-align: center;
    }
</style>
<!-- <script src="_eclassroom_js/papaparse.min.js"></script> -->

<div class="container">

    <div class="row">
        <div class="">

            <div class="col-md-2">
                <br><br>

                <b><small >Lecturer Info</small></b>
                <div class="alert alert-info" style="font-size:12px;">Drag lecturer name to any of the slot</div>
                <div class="list-group" id="lecturer-info-handler">
                    <?php
$query = $phpEasy->query('lecturer');

if ($query->rowCount() > 0) {
	$key_ = 0;
	while ($ft = $query->fetch()) {
		# code...
		?>
        <a href="#" class="list-group-item dragelement<?php echo $key_ ?>" style="font-size: 13px;" ondragStart="dragStart(event)">
                            <?php echo $ft['full_name'] ?>
        </a>
                            <?php
$key_++;
	}
} else {
	echo "No lecturer info available";
}
?>

                </div>

                <button data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-info" style="padding: 5px;font-size:12px;font-weight: bold;width: 100%"><i class="fa fa-edit"></i> Add Course</button>
                <?php
$query_obj = $phpEasy::$db_connect->query("SELECT * FROM courses WHERE title !='' ");
if ($query_obj->rowCount() > 0) {
	?>
                    <div class="list-group">
                    <?php
$key1 = 0;
	while ($fetch_obj = $query_obj->fetch()) {
		?>
                        <a href="#" class="list-group-item dragCourse<?php echo $key1 ?>" style="font-size: 13px;" ondragStart="courseDrag(event)">
                            <?php echo $fetch_obj['title'] ?>
                            <br>
                                <b><small><?php echo $fetch_obj['code'] ?></small></b>
                            </a>
                        <?php
$key1++;
	}?>
                    </div>
                <?php } else {
	echo "<p><small>Please Add up some courses here</small></p>";
}
?>

            </div>
            <div class="col-md-10">
                <h3>Course Allocation</h3>
            <div style="background: #EEE;padding: 10px;">
                <select style="width: 200px" id="level">
                    <option value="nd1">ND I</option>
                    <option value="nd2">ND II</option>
                    <option value="hnd1">HND I</option>
                    <option value="hnd2">HND II</option>
                </select>
                <select style="width:200px" id="semester">
                    <option value="first">First Semester</option>
                    <option value="second">Second Semester</option>
                </select>
                <select style="width:200px" id="dept">
                    <option value="comp-sci">Computer Science</option>
                    <option value="comp-eng">Computer Engineering</option>
                </select>
                <button class="btn-sm btn btn-info" style="padding: 5px;font-size:12px;" onclick="loadData()">Submit</button>
                <button class="btn-sm btn btn-success" onclick="exportAsCsv()" style="padding: 5px;font-size:12px;font-weight: bold;">Export Data</button>
                &nbsp;<a href="admin.php">logout</a>
            </div>
            <table class="table table-responsive">
                <tr>
                    <th> Days </th>
                    <th>8-10 AM</th>
                    <th>10-12 PM</th>
                    <th>12-2 PM</th>
                    <th>2-4 PM</th>
                    <th>4-6 PM</th>
                </tr>
                <?php
$days = ['mon', 'tue', 'wed', 'thur', 'fri', 'sat'];
foreach ($days as $key => $value) {
	# code...
	?>
    <tr >
        <th style="padding-top: 10px;padding-bottom: 20px !important;"><?php echo strtoupper($value) ?></th>
        <th>
            <div class="<?php echo 'A-' . $key ?> smaller" ondragover="allowDrop(event)" ondrop="drop(event)">
                drag lecturer here
            </div>
            <div class="course__small <?php echo 'A-X-' . $key ?>" data-id="" ondragover="courseDrop(event)" ondrop="cDrop(event)"> drag course here </div>
        </th>
        <th>
            <div class="<?php echo 'B-' . $key ?> smaller" ondragover="allowDrop(event)" ondrop="drop(event)">
                drag lecturer here
            </div>
            <div class="course__small <?php echo 'B-X-' . $key ?>" ondragover="courseDrop(event)" ondrop="cDrop(event)"> drag course here</small></div></th>
        <th>
            <div class="<?php echo 'C-' . $key ?> smaller" ondragover="allowDrop(event)" ondrop="drop(event)">
                drag lecturer here
            </div>
            <div class="course__small <?php echo 'C-X-' . $key ?>" ondragover="courseDrop(event)" ondrop="cDrop(event)"> drag course here</div>
        </th>
        <th>
            <div class="<?php echo 'D-' . $key ?> smaller" ondragover="allowDrop(event)" ondrop="drop(event)" >
                drag lecturer here
            </div>
            <div class="course__small <?php echo 'D-X-' . $key ?>" ondragover="courseDrop(event)" ondrop="cDrop(event)">drag course here</div>
        </th>
        <th>
            <div class="<?php echo 'E-' . $key ?> smaller" ondragover="allowDrop(event)" ondrop="drop(event)">
                drag lecturer here
            </div>
            <div class="course__small <?php echo 'E-X-' . $key ?>" ondragover="courseDrop(event)" ondrop="cDrop(event)">drag course here</div>
        </th>
    </tr>
                    <?php
}
?>
            </table>
        </div>
        </div>
    </div>
        <div class="clearfix"></div>
        <br/>
        <br/>

    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document" style="z-index: 10000;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Course</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-info" style="font-size: 12px"><b>Note:</b> the course code must be written like this (COM 111)</div>
        <form method="post">
                <label>Title</label>
                <input type="text" class="form-control" name="title" id="title">

                 <label>Code</label>
                <input type="text" class="form-control" name="code" id="code">

                <label>Unit</label>
                <input type="number" class="form-control" name="unit" id="unit">
        </  form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addCourses()">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

    function addCourses() {
        const title = document.querySelector('#title');
        const unit = document.querySelector('#unit');
        const code = document.querySelector('#code');
        if (title.value === '') {
            title.focus();
            return false;
        } else if ((code.value === '') || (!code.value.match(/^([A-Z]{3})\s([\d]{3})$/))) {
            code.focus();
            return false;
        } else if ((unit.value === '') || (!unit.value.match(/^\d+$/))) {
            unit.focus();
            return false;
        } else {
            const data_list = `title=${title.value}&code=${code.value}&unit=${unit.value}`;
            ajax('load-data.php?rel=add-course', data_list, function(response) {
                if (response.trim() === 'saved') {
                    window.location.reload();
                } else if (response.trim() == 'exist') {
                    alert('Record Already Exist');
                } else {
                    alert('Error Occured');
                }
            });
        }
    }

    let cid;
    function courseDrop(e) {
        e.preventDefault();
    }
    function courseDrag(e) {
        _id = e.srcElement.className;
        split = _id.split(' ');
        cid = split[1];
    }
    function cDrop(e) {
        try {
            let data = document.getElementsByClassName(cid);
            // e.target.innerHTML = "";
            if (data[0] === undefined) {
                throw 'You dragged it to wrong location';
            }
            let split = data[0].innerText.split(' ');
            const course_code = `${split[split.length-2].trim()} ${split[split.length-1].trim()}`;
            e.target.innerText = course_code;

            let split_ = e.target.className;
            let _x = split_.split(' ');
            let delete_x = _x[1].replace('-X', '');
            let extract_info = document.querySelector(`.${delete_x}`)
            let alloc_id = extract_info.getAttribute('allocation-id');
            const data_string = `allocation_id=${alloc_id}&slot_id=${delete_x}&code=${course_code}`;
            ajax('load-data.php?rel=update-course', data_string, function(output) {
                if(output.trim() == 'error') {
                    alert('Please drag lecturer to the gray box before adding preferred course');
                    data[0].innerText = 'drag course here';
                } else {
                    console.log(output);
                }
            });

        } catch(e) {
            alert("This is a wrong location, please drag on the gray box")
        }
    }

    let uid;
    function allowDrop(e) {
        e.preventDefault();
    }

    function dragStart(e) {
        _id = e.srcElement.className;
        split = _id.split(' ');
        uid = split[1];
    }

    function drop(e) {
        try {
            let data = document.getElementsByClassName(uid);
            // e.target.style.background = '#EEE';
            // e.target.innerHTML = "";
            console.log(data[0])
            if (data[0] === undefined) {
                throw "You dragged it to wrong location";
            }
            e.target.innerText = data[0].innerText;
            const level = document.getElementById('level');
            const semester = document.getElementById('semester');
            const dept = document.getElementById('dept');
            const lecturer = data[0].innerText.trim();
            const slot = e.target.className;
            const split_slot = slot.split(' ');
            const slot_pot = split_slot[0];
            const data_object = `level=${level.value}&semester=${semester.value}&dept=${dept.value}&lecturer=${lecturer}&slot=${slot_pot}`;
            console.log(slot)
            ajax('store-allocation.php', data_object, function(response) {
                console.log(response);
            })
        }catch(e) {
            alert('This is a wrong location, please drag below the gray box');
            return false;
        }
        // data[0].remove();
        // monitorLecturerHandler();
    }

    function ajax(url, data, callback) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        //Send the proper header information along with the request
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() { // Call a function when the state changes.
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                // Request finished. Do processing here.
                return callback(xhr.responseText);
            }
        }
        xhr.send(data);
    }

    // function monitorLecturerHandler() {
    //     let elem = document.querySelectorAll('#lecturer-info-handler a');
    //     let srcElem = document.querySelector('#lecturer-info-handler');
    //     if (parseInt(elem.length) < 1) srcElem.innerHTML = '<i><small>No Lecturer Available</small></i>';
    //     console.log(elem.length + ' remain')
    // }

    function loadData() {
        let level = document.getElementById('level');
        let semester = document.getElementById('semester');
        let dept = document.getElementById('dept');
        let data = `level=${level.value}&semester=${semester.value}&dept=${dept.value}`;
        ajax('load-data.php?rel=table', data, function(response) {
            let result = JSON.parse(response);
            console.log(result);
            if (result.count > 0) {
                result.data.forEach(function(value, key) {
                    let slot_elem = value.slot_id;
                    let lect = value.lecturer;
                    document.querySelector(`.${slot_elem}`).innerHTML = '';
                    document.querySelector(`.${slot_elem}`).innerText = lect;
                    document.querySelector(`.${slot_elem}`).setAttribute('allocation-id', value.allocation_id);
                    let add_x = `${slot_elem.substr(0, 1)}-X${slot_elem.substr(1)}`
                    document.querySelector(`.${add_x}`).innerText = value.course || 'drag course here';
                    // document.querySelector(`.${slot_elem}`).innerText = lect;
                })
            } else {
                let numOfDays, days;
                for ( numOfDays = 0; numOfDays <= 5; numOfDays++) {
                    let aElemClass = `.A-${numOfDays}`;
                    let bElemClass = `.B-${numOfDays}`;
                    let cElemClass = `.C-${numOfDays}`;
                    let dElemClass = `.D-${numOfDays}`;
                    let eElemClass = `.E-${numOfDays}`;
                    document.querySelector(aElemClass).innerHTML = 'drag lecturer here';
                    document.querySelector(bElemClass).innerHTML = 'drag lecturer here';
                    document.querySelector(cElemClass).innerHTML = 'drag lecturer here';
                    document.querySelector(dElemClass).innerHTML = 'drag lecturer here';
                    document.querySelector(eElemClass).innerHTML = 'drag lecturer here';
                    let aElemSubClass = `.A-X-${numOfDays}`;
                    let bElemSubClass = `.B-X-${numOfDays}`;
                    let cElemSubClass = `.C-X-${numOfDays}`;
                    let dElemSubClass = `.D-X-${numOfDays}`;
                    let eElemSubClass = `.E-X-${numOfDays}`;
                    document.querySelector(aElemSubClass).innerHTML = 'drag course here';
                    document.querySelector(bElemSubClass).innerHTML = 'drag course here';
                    document.querySelector(cElemSubClass).innerHTML = 'drag course here';
                    document.querySelector(dElemSubClass).innerHTML = 'drag course here';
                    document.querySelector(eElemSubClass).innerHTML = 'drag course here';
                    // console.log(`${days[numOfDays]}-${numOfDays}`)
                }
            }
        });
        // console.log(level.value +', ' + semester.value)
    }

    function exportAsCsv() {
        const level = document.getElementById('level');
        const semester = document.getElementById('semester');
        const dept = document.getElementById('dept');
        const dataString = `level=${level.value}&semester=${semester.value}&dept=${dept.value}`;
        window.location = `export.php?${dataString}`;
    }

    window.onload = function() {
        loadData();
    }

</script>
<?php
require "footer.php";
?>
</body>

</html>