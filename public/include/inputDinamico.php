<tr>

    <td>
        <input type="checkbox" name="item_index[]" />
    </td>
                        <td>
                            <input type="text" class="form-control" name="nombre[]">
                        </td>
                        <td>
                            <select name="tipo[]" class="form-control">
                                <option value="TINYINT">TINYINT</option>
                                <option value="SMALLINT">SMALLINT</option>
                                <option value="MEDIUMINT">MEDIUMINT</option>
                                <option value="INT">INT</option>
                                <option value="BIGINT">BIGINT</option>
                                <option value="FLOAT">FLOAT</option>
                                <option value="DOUBLE">DOUBLE</option>
                                <option value="DECIMAL">DECIMAL</option>
                                <option value="VARCHAR">VARCHAR</option>
                                <option value="CHAR">CHAR</option>
                                <option value="TINYTEXT">TINYTEXT</option>
                                <option value="TEXT">TEXT</option>
                                <option value="MEDIUMTEXT">MEDIUMTEXT</option>
                                <option value="LONGTEXT">LONGTEXT</option>
                                <option value="JSON">JSON</option>
                                <option value="BINARY">BINARY</option>
                                <option value="VARBINARY">VARBINARY</option>
                                <option value="TINYBLOB">TINYBLOB</option>
                                <option value="BLOB">BLOB</option>
                                <option value="MEDIUMBLOB">MEDIUMBLOB</option>
                                <option value="LONGBLOB">LONGBLOB</option>
                                <option value="DATE">DATE</option>
                                <option value="TIME">TIME</option>
                                <option value="YEAR">YEAR</option>
                                <option value="DATETIME">DATETIME</option>
                                <option value="TIMESTAMP">TIMESTAMP</option>
                                <option value="POINT">POINT</option>
                                <option value="LINESTRING">LINESTRING</option>
                                <option value="POLYGON">POLYGON</option>
                                <option value="GEOMETRY">GEOMETRY</option>
                                <option value="MULTIPOINT">MULTIPOINT</option>
                                <option value="MULTILINESTRING">MULTILINESTRING</option>
                                <option value="MULTIPOLYGON">MULTIPOLYGON</option>
                                <option value="GEOMETRYCOLLECTION">GEOMETRYCOLLECTION</option>
                                <option value="UNKNOWN">UNKNOWN</option>
                                <option value="ENUM">ENUM</option>
                                <option value="SET">SET</option>
                            </select>
                        </td>
                        <td>
                            <div class="form-check">
                                <input type="checkbox" value="null" class="form-check-input" name="null[]">
                                <label class="form-check-label" for="exampleCheck1">NULL</label>
                            </div>
                        </td>
                            <td>
                                <select name="predeterminado[]" class="form-control">
                                    <option value="s">Sin valor predeterminado</option>
                                    <option value="NULL">NULL</option>
                                    <option value="AUTO_INCREMENT">AUTO_INCREMENT</option>
                                </select>

                            </td>
                        <td>
                            <input type="text" name="comentario[]" class="form-control">
                        </td>
                        </tr>

