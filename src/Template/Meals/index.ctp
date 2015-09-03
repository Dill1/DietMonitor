<html>
<head></head>

<body ng-app="dmApp" ng-controller="appCtrl">



<div class="actions columns large-2 medium-3">
	<h3>Search</h3>
	Dates Between 
	<input type="date" ng-model="fromDate"></input>
	and
	<input type="date" ng-model="toDate"></input>

	Times Between
	<input type="time" ng-model="fromTime"></input>
	and
	<input type="time" ng-model="toTime"></input>

	<button ng-click="getMeals()">Search Meals</button>
</div>


<div class="meals index large-10 medium-9 columns">

	<div style="text-align: right; margin-right: 3em">Welcome <?= $username ?>! <a href="/users/logout">Log Out</a></div>

	<h3 ng-init="total_expected=<?= $usertotal ?>" class="{{ total_expected < todaysTotalCalories ? 'behind' : 'ahead' }}">
		Expected total calories daily: <?= $usertotal ?>
	</h3>

	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th>Entered Date</th>
				<th>Time</th>
				<th>Description</th>
				<th>Calories</th>
				<th class="actions"></th>
			</tr>
		</thead>
		<tbody>
			<!-- new meal -->
			<tr>
				<td><input type="date" ng-model="newField.date"/></td>
				<td><input type="time" ng-model="newField.time"/></td>
				<td><input type="text" ng-model="newField.description"/></td>
				<td><input type="number" ng-model="newField.calories"/></td>
				<td><button ng-click="addNewMeal()">Add New</button></td>
			</tr>
			<tr ng-hide="isEmpty(addNewMealError)"><td colspan="2"><span class="error" ng-bind="addNewMealError" /></td></tr>
			
			<!-- existing meal -->
			<tr ng-repeat="meal in meals | orderBy : ['date','time']">
				<!-- view mode -->
				<td ng-if="edit.id != meal.id">{{ meal.date | date: "MM/dd/yyyy" }}</td>
				<td ng-if="edit.id != meal.id">{{ meal.time | date: "h:mma" }}</td>
				<td ng-if="edit.id != meal.id">{{ meal.description }}</td>
				<td ng-if="edit.id != meal.id">{{ meal.calories }}</td>
				<td ng-if="edit.id != meal.id">
					<button ng-if="edit != meal.id" ng-click="editMeal(meal)">Edit</button>
					<button ng-if="edit != meal.id" ng-click="deleteMeal(meal)">Delete</button>
				</td>

				<!-- edit mode -->
				<td ng-if="edit.id == meal.id"><input type="date" ng-model="edit.date"/></td>
				<td ng-if="edit.id == meal.id"><input type="time" ng-model="edit.time"/></td>
				<td ng-if="edit.id == meal.id"><input type="text" ng-model="edit.description"/></td>
				<td ng-if="edit.id == meal.id"><input type="number" ng-model="edit.calories"/></td>
				<td ng-if="edit.id == meal.id">
					<button ng-if="edit.id == meal.id" ng-click="saveMeal()">Save</button>
					<button ng-if="edit.id == meal.id" ng-click="cancelEdit()">Cancel</button>
				</td>
			</tr>
			<tr ng-hide="isEmpty(editMealError)" ng-if="edit.id == meal.id"><td colspan="2"><span class="error" ng-bind="editMealError"/></td></tr>
		</tbody>
	</table>
	<button ng-click="getAllMeals()">Show All Meals</button>
</div>


<div ng-show="showModal" id="modal">
	Loading, please wait....
</div>

</body></html>


