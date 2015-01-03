<?php

class personTest{

    function skiptestBuildPerson() {
        $expectedPersonId = 2;
        $expectedPerson = new person();
        $expectedPerson->setName("Robert Snyder");
        $thisPerson = new person();
        $thisPerson->select($expectedPersonId);
        if ($expectedPerson->Name != $thisPerson->Name) {
            throw new exception("Expected $expectedPerson but found $thisPerson");
        }
    }

}

?>