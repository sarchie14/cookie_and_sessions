<main>
    <nav>
        <form action="." method="get" id="make_selection">
            <section id="dropmenus">
                <?php if ( sizeof($makes) != 0) { ?>
                    
                    <label>Make:</label>
                    <select name="make">
                        <option value="0">View All Makes</option>
                        <?php foreach ($makes as $make) : ?>
                            <option value="<?php echo $make['make']; ?>">
                                <?php echo $make['make']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select> 
                <?php } ?>

                <?php if ( sizeof($types) != 0) { ?>
                    <label>Types:</label>
                    <select name="type_id">
                        <option value="0">View All Types</option>
                        <?php foreach ($types as $type) : ?>
                            <option value="<?php echo $type['typeID']; ?>">
                                <?php echo $type['typeName']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select> 
                <?php } ?>

                <?php if ( sizeof($classes) != 0) { ?>
                    <label>Class:</label>
                    <select name="class_id">
                        <option value="0">View All Classes</option>
                        <?php foreach ($classes as $class) : ?>
                            <option value="<?php echo $class['classID']; ?>">
                                <?php echo $class['className']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select> 
                    
                <?php } ?>
            </section>
            <section id="sortBy">
                <div>
                    <span>Sort by: </span>
                    <input type="radio" id="sortByPrice" name="sort" value="price" checked>
                    <label for="sortByPrice">Price</label> 
                    <input type="radio" id="sortByYear" name="sort" value="year">
                    <label for="sortByYear">Year</label>
                    <input type="submit" value="Submit Search" class="button blue button-slim">
                </div>
            </section>
        </form>
    </nav>
    <section>
        <?php if( sizeof($vehicles) != 0 ) { ?>
            <div id="table-overflow">
                <table>
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>Make</th>
                            <th>Model</th>
                            <th>Type</th>
                            <th>Class</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vehicles as $vehicle) : ?>
                        <tr>
                            <td><?php echo $vehicle['vYear']; ?></td>
                            <td><?php echo $vehicle['make']; ?></td>
                            <td><?php echo $vehicle['model']; ?></td>
                            <?php if ($vehicle['typeName'] == null || $vehicle['typeName'] == false) { ?>
                                <td>None</td>
                            <?php } else { ?>
                                <td><?php echo $vehicle['typeName']; ?></td>
                            <?php } ?>
                            <?php if ($vehicle['className'] == null || $vehicle['className'] == false) { ?>
                                <td>None</td>
                            <?php } else { ?>
                                <td><?php echo $vehicle['className']; ?></td>
                            <?php } ?>
                            <td><?php echo "$".number_format($vehicle['price'], 2); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>  
        <?php } else { ?>
            <p>
                There are no matching vehicles in Zippy&apos;s inventory. 
            </p>     
        <?php } ?>
    </section>
</main>