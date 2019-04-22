/****** Object:  Table [dbo].[Machine]    Script Date: 4/22/2019 5:39:50 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[Machine](
	[MachineID] [int] IDENTITY(1,1) NOT NULL,
	[OnOff] [int] NOT NULL,
	[RunTime] [int] NOT NULL,
	[HowManyMotors] [int] NOT NULL,
	[MachineFunction] [varchar](255) NOT NULL,
	[MachineMonitoring] [varchar](255) NOT NULL,
	[LastMaintenanceDate] [date] NOT NULL,
	[AddressID] [int] NOT NULL,
	[FaultID] [int] NOT NULL,
	[SerialNumber] [varchar](50) NOT NULL,
	[Model] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Machine] PRIMARY KEY CLUSTERED 
(
	[MachineID] ASC
)WITH (STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[Machine]  WITH CHECK ADD  CONSTRAINT [FK_Machine_Address] FOREIGN KEY([AddressID])
REFERENCES [dbo].[Address] ([AddressID])
GO

ALTER TABLE [dbo].[Machine] CHECK CONSTRAINT [FK_Machine_Address]
GO

ALTER TABLE [dbo].[Machine]  WITH CHECK ADD  CONSTRAINT [FK_Machine_Faults] FOREIGN KEY([FaultID])
REFERENCES [dbo].[Faults] ([FaultID])
GO

ALTER TABLE [dbo].[Machine] CHECK CONSTRAINT [FK_Machine_Faults]
GO


