import com.intellij.database.model.DasTable
import com.intellij.database.util.Case
import com.intellij.database.util.DasUtil

/*
 * Available context bindings:
 *   SELECTION   Iterable<DasObject>
 *   PROJECT     project
 *   FILES       files helper
 */

packageName = "com.sample;"
typeMapping = [
  (~/(?i)int/)                      : "int",
  (~/(?i)float|double|decimal|real/): "float",
  (~/(?i)datetime|timestamp/)       : "\\DateTimeInterface",
  (~/(?i)date/)                     : "\\DateInterface",
  (~/(?i)time/)                     : "\\TimeInterface",
  (~/(?i)json|jsonb/)               : "array",
  (~/(?i)/)                         : "string"
]

FILES.chooseDirectoryAndSave("Choose directory", "Choose where to store generated files") { dir ->
  SELECTION.filter { it instanceof DasTable }.each { generate(it, dir) }
}

def generate(table, dir) {
  def className = javaName(table.getName(), true)
  def fields = calcFields(table)
  new File(dir, className + ".prefab.definition.yml").withPrintWriter { out ->
    generate(out, table.getName(), fields)
  }
}

def generate(out, tableName, fields) {
  out.println "dao:"
  out.println "  table_name: $tableName"
  out.println "  identity_field: id"
  out.println "  http_route: EDIT_ME/{searchCriteria:}"
  out.println "  properties:"
  fields.each() {
    out.println "    ${it.name}:"
    out.println "      php_type: ${it.type}"
    out.println "      database_column_name: ${it.name}"
  }
}

def calcFields(table) {
  DasUtil.getColumns(table).reduce([]) { fields, col ->
    def spec = Case.LOWER.apply(col.getDataType().getSpecification())
    def typeStr = typeMapping.find { p, t -> p.matcher(spec).find() }.value
    fields += [[
                 name : col.getName(),
                 type : typeStr,
                 annos: ""]]
  }
}

def javaName(str, capitalize) {
  def s = com.intellij.psi.codeStyle.NameUtil.splitNameIntoWords(str)
    .collect { Case.LOWER.apply(it).capitalize() }
    .join("")
    .replaceAll(/[^\p{javaJavaIdentifierPart}[_]]/, "_")
  capitalize || s.length() == 1? s : Case.LOWER.apply(s[0]) + s[1..-1]
}

