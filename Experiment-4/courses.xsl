<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">

<html>

<head>

<title>DTU Course Catalogue</title>

<style>

body {
    font-family: Arial, sans-serif;
    background-color: #f7f5ef;
    margin: 0;
    padding: 40px;
    color: #333;
}

.container {
    max-width: 1100px;
    margin: auto;
}

h1 {
    text-align: center;
    color: #52664f;
    margin-bottom: 5px;
}

.subtitle {
    text-align: center;
    color: #777;
    margin-bottom: 35px;
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: white;
}

th {
    background-color: #52664f;
    color: white;
    padding: 14px;
    text-align: left;
}

td {
    padding: 13px;
    border-bottom: 1px solid #ddd;
}

tr:hover {
    background-color: #f0eee7;
}

.core {
    color: #52664f;
    font-weight: bold;
}

.elective {
    color: #8a6d3b;
    font-weight: bold;
}

</style>

</head>

<body>

<div class="container">

<h1>Delhi Technological University</h1>

<p class="subtitle">
Course Catalogue
</p>

<table>

<tr>
    <th>Course ID</th>
    <th>Course Name</th>
    <th>Course Code</th>
    <th>Faculty</th>
    <th>Credits</th>
    <th>Course Type</th>
</tr>

<xsl:for-each select="courseCatalogue/course">

<tr>

<td>
    <xsl:value-of select="courseID"/>
</td>

<td>
    <xsl:value-of select="courseName"/>
</td>

<td>
    <xsl:value-of select="courseCode"/>
</td>

<td>
    <xsl:value-of select="faculty"/>
</td>

<td>
    <xsl:value-of select="credits"/>
</td>

<td>

    <xsl:choose>

        <xsl:when test="courseType='Core'">
            <span class="core">
                <xsl:value-of select="courseType"/>
            </span>
        </xsl:when>

        <xsl:otherwise>
            <span class="elective">
                <xsl:value-of select="courseType"/>
            </span>
        </xsl:otherwise>

    </xsl:choose>

</td>

</tr>

</xsl:for-each>

</table>

</div>

</body>

</html>

</xsl:template>

</xsl:stylesheet>