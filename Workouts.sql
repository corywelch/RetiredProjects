select 
	u.id as "User Id",
	u.username as 'Username',
	w.date as "Date",
	w.`start_time` as "Start Time",
	be.name as 'Base Exercise',
	e.name as 'Exrcise',
	st.type as 'Exercise Type',
	s.weight as 'Weight',
	e.unit as 'Unit',
	s.`reps_time` as 'Reps/Time',
	e.type as "Type",
	msl.order as "Set Order",
	wml.order as "Move Order",
	w.note as "Workout Note",
	m.note as "Move Note",
	s.note as "Set Note",
	l.name as "Location",
	e.`description` as "Description",
	w.id as "Workout ID",
	m.id as "Move ID",
	s.id as "Set ID"
from workout_move_link wml 
	join move m on m.id=wml.move_id 
	join workout w on w.id=wml.workout_id
	join move_set_link msl on msl.move_id=m.id
	join `user` u on u.id=m.user_id 
	join `set` s on s.id=msl.`set_id` 
	join exercise be on be.id=m.`base_exercise_id` 
	join exercise e on e.id=s.`exercise_id` 
	join set_type st on st.id=s.`set_type_id`
	join location l on l.id=w.`location_id`
where w.`user_id`=(select id from `user` where username='cwelch')
order by w.date, wml.order, msl.order;