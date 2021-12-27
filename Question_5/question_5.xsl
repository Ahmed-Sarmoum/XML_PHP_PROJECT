<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:xs="http://www.w3.org/2001/XMLSchema" exclude-result-prefixes="xs" version="1.0">
    
    <xsl:output method="html" indent="yes"/>
    <xsl:template match="/">
        <html>
            <head>Question 5</head>
            <body>
                <table border="1">
                    <tr style="background: green; color:white">
                        <th >Day</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Teacher</th>
                        <th>Module</th>
                        <th>Salle</th>
                    </tr>
                    
                    <xsl:for-each select="/emploi/seance">
                        <tr>
                            <td> <xsl:value-of select="@day"/> </td>
                            <td> <xsl:value-of select="@start"/> </td>
                            <td> <xsl:value-of select="@end"/> </td>
                            <td>  <xsl:value-of select="@teacher"/>  </td>
                            <td> <xsl:value-of select="@module"/>  </td>
                            <td>  <xsl:value-of select="@salle"/> </td>
                        </tr>
                    </xsl:for-each>
                </table>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>