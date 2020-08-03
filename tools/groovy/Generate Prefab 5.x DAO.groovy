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
  (~/(?i)int/)                              : "int",
  (~/(?i)float|double|decimal|real|numeric/): "float",
  (~/(?i)datetime|timestamp/)               : "\\DateTimeInterface",
  (~/(?i)date/)                             : "\\DateInterface",
  (~/(?i)time/)                             : "\\TimeInterface",
  (~/(?i)json|jsonb/)                       : "array",
  (~/(?i)bool/)                             : "bool",
  (~/(?i)/)                                 : "string"
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
  def primary = '';
  fields.each() {
    if(it.primary) {
      primary = it.name;
    }
  }

  out.println "last_checked_prefab_version: null"
  out.println "table_name: $tableName"
  out.println "supporting_actor_group: complete"
  out.println "identity_field: $primary"
  out.println "http_route: EDIT_ME"
  out.println "http_verbs:"
  out.println "  - get"
  out.println "properties:"
  fields.each() {
    out.println "  ${it.name}:"
    out.println "    data_type: ${it.type}"
    out.println "    record_key: ${it.name}"
    out.println "    nullable: ${it.nullable}"
    out.println "    created_on_insert: ${it.created_on_insert}"
  }
}

def calcFields(table) {
  DasUtil.getColumns(table).reduce([]) { fields, col ->
    def spec = Case.LOWER.apply(col.getDataType().getSpecification())
    def typeStr = typeMapping.find { p, t -> p.matcher(spec).find() }.value
    fields += [[
                 name : col.getName(),
                 type : typeStr,
                 primary : DasUtil.isPrimary(col),
                 nullable : !col.isNotNull(),
                 created_on_insert : col.getDefault() ? true : false
                 ]]
  }
}

def javaName(str, capitalize) {
  def s = com.intellij.psi.codeStyle.NameUtil.splitNameIntoWords(str)
    .collect { Case.LOWER.apply(it).capitalize() }
    .join("")
    .replaceAll(/[^\p{javaJavaIdentifierPart}[_]]/, "_")
  capitalize || s.length() == 1? s : Case.LOWER.apply(s[0]) + s[1..-1]
}
